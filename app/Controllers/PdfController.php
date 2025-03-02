<?php namespace App\Controllers;

class PdfController extends BaseController
{
    public function viewIframe($filename)
    {
        // Build the PDF URL relative to your document root (public_html)
        $pdfUrl = base_url('uploads/book_pdfs/' . $filename);
      
        return view('pdf_viewer', ['pdfUrl' => $pdfUrl]);
    }

    public function display($filename)
    {
        $filePath = FCPATH . 'uploads/book_pdfs/' . $filename; // FCPATH points to public_html
        if (!is_file($filePath)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("File not found: " . $filename);
        }

        $fileContent = file_get_contents($filePath);
        return $this->response
            ->setContentType('application/pdf')
            ->setHeader('Content-Disposition', 'inline; filename="' . $filename . '"')
            ->setBody($fileContent);
    }
}
