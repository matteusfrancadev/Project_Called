<?php

namespace App\Http\Controllers;

use App\Http\Requests\AttachmentRequest;
use App\Models\Attachment;
use Illuminate\Http\Request;

class AttachmentController extends Controller
{
    public function uploadAttachment(AttachmentRequest $request)
{
    $file = $request->file('attachment');
    $filename = $file->getClientOriginalName();

    // Salvar o arquivo no storage
    $path = $file->storeAs('attachments', $filename);

    // Salvar os detalhes do anexo no banco de dados
    $attachment = Attachment::create([
        'filename' => $filename,
        'path' => $path,
    ]);
}
}
