<?php

namespace AsyncAws\Rekognition\Tests\Unit\Input;

use AsyncAws\Core\Test\TestCase;
use AsyncAws\Rekognition\Input\RecognizeCelebritiesRequest;
use AsyncAws\Rekognition\ValueObject\Image;
use AsyncAws\Rekognition\ValueObject\S3Object;

class RecognizeCelebritiesRequestTest extends TestCase
{
    public function testRequest(): void
    {
        $input = new RecognizeCelebritiesRequest([
            'Image' => new Image([
                'Bytes' => 'change me',
                'S3Object' => new S3Object([
                    'Bucket' => 'change me',
                    'Name' => 'change me',
                    'Version' => 'change me',
                ]),
            ]),
        ]);

        // see https://docs.aws.amazon.com/rekognition/latest/dg/API_RecognizeCelebrities.html
        $expected = '
            POST / HTTP/1.0
            Content-Type: application/x-amz-json-1.1
            x-amz-target: RekognitionService.RecognizeCelebrities

            {
            "Image": {
                "Bytes": "Y2hhbmdlIG1l",
                "S3Object": {
                    "Bucket": "change me",
                    "Name": "change me",
                    "Version": "change me"
                }
            }
        }';

        self::assertRequestEqualsHttpRequest($expected, $input->request());
    }
}
