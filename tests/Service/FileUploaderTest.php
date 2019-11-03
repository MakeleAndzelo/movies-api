<?php

declare(strict_types=1);

namespace App\Tests\Service;

use App\Service\FileUploader;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;

final class FileUploaderTest extends TestCase
{
    /**
     * @test
     */
    public function upload_test(): void
    {
        $fileUploader = new FileUploader('test');

        /** @var UploadedFile|MockObject $uploadedFileMock */
        $uploadedFileMock = $this->createMock(UploadedFile::class);

        $uploadedFileMock
            ->expects(self::once())
            ->method('getClientOriginalName')
            ->willReturn('testing.jpg');

        $uploadedFileMock
            ->expects(self::once())
            ->method('guessExtension')
            ->willReturn('jpg');

        $uploadedFileMock
            ->expects(self::once())
            ->method('move');

        $fileName = $fileUploader->upload($uploadedFileMock);

        $this->assertContains('testing', $fileName);
        $this->assertContains('.jpg', $fileName);
    }
}
