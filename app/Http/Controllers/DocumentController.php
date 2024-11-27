<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Utilisateur;
use App\Models\Document;

class DocumentController extends Controller
{
    public function telechargerDocument($documentId)
    {
        $document = Document::findOrFail($documentId);
        
        // Décoder et préparer le fichier pour le téléchargement
        $fileData = base64_decode($document->file_stream);
        $fileName = $document->file_name;
    
        return response()->make($fileData, 200, [
            'Content-Type' => $document->file_type,
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ]);
    }

    /*
    protected function getFileIcon($mimeType)
    {
        $iconMapping = [
            'application/pdf' => 'fa-solid fa-file-pdf', // PDF icon (PDF)

            'image/jpeg' => 'fa-solid fa-file-image',    // Image icon (JPEG or JPG)

            'application/msword' => 'fa-solid fa-file-word', // Word document (DOC)
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'fa-solid fa-file-word', // Word (DOCX)

            'application/vnd.ms-excel' => 'fa-solid fa-file-excel', // Excel (XLS)
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => 'fa-solid fa-file-excel', // Excel (XLSX)
        ];

        
        return $iconMapping[$mimeType] ?? 'fa-solid fa-file'; // Default icon if type not found
    }*/

}
