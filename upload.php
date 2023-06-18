<?php
$bucket = 'php-82';

// Check if file was uploaded without errors
if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
    $file = $_FILES["file"]["tmp_name"];
    $filename = $_FILES["file"]["name"];

    require 'vendor/autoload.php'; // Include the AWS SDK for PHP

    $s3 = new Aws\S3\S3Client([
        'version' => 'latest',
        'region' => 'eu-north-1',
        'credentials' => [
            'key' => 'AKIAZY6ILOGRQABNS4EN',
            'secret' => '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',
            
        ],    
    ]);

    try {
        // Upload the file to S3
        $result = $s3->putObject([
            'Bucket' => $bucket,
            'Key' => $filename,
            'SourceFile' => $file,
        ]);

        // Store file details in DynamoDB
        $dynamodb = new Aws\DynamoDb\DynamoDbClient([
            'version' => 'latest',
            'region' => 'eu-north-1',
        ]);

        $dynamodb->putItem([
            'TableName' => 'ph2_v2',
            'Item' => [
                'file_id' => ['S' => $result['ETag']],
                'file_name' => ['S' => $filename],
                'file_url' => ['S' => $result['ObjectURL']],
            ],
        ]);

        echo "File uploaded successfully! You can access it at: " . $result['ObjectURL'];
    } catch (Aws\S3\Exception\S3Exception $e) {
        echo "Error uploading file: " . $e->getMessage();
    } catch (Aws\DynamoDb\Exception\DynamoDbException $e) {
        echo "Error storing file details: " . $e->getMessage();
    }
} else {
    echo "Error uploading file.";
}
