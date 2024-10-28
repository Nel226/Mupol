<?php

namespace App\Helpers;

use Dompdf\Dompdf;
use Dompdf\Options;

class PDFHelper
{
    /**
     * Generate and download a PDF file from a given view.
     * 
     * @param string $viewPath The view path that will be rendered into a PDF.
     * @param array $data Data to be passed to the view.
     * @param string $fileName The name of the PDF file to download.
     * @param array $options Additional Dompdf options like paper size, orientation, etc.
     * @return \Illuminate\Http\Response The PDF stream response.
     */
    public static function downloadPDF($viewPath, $data, $fileName, $options = [])
    {
        // Setup default options
        $dompdfOptions = new Options();
        $dompdfOptions->set('chroot', public_path());
        
        // Define font directory
        $fontDir = public_path('fonts');
        $dompdfOptions->set('fontDir', $fontDir);

        // Define custom font if available
        $dompdfOptions->set('defaultFont', 'Open Sans'); // Set Poppins as default font if needed
        
        // Initialize Dompdf with the configured options
        $dompdf = new Dompdf($dompdfOptions);

        // If additional Dompdf options are passed, merge them
        if (!empty($options)) {
            foreach ($options as $key => $value) {
                $dompdfOptions->set($key, $value);
            }
        }

        // Handle logo or other image paths in the data (optional)
        if (isset($data['logoPath'])) {
            $data['logoDataUrl'] = ImageHelper::imageToDataUrl($data['logoPath']);
        }

        // Render the view to HTML and load it into Dompdf
        $pdfView = view($viewPath, $data)->render();
        $dompdf->loadHtml($pdfView);

        // Optionally set paper size and orientation if provided
        $dompdf->setPaper($options['paper'] ?? 'A4', $options['orientation'] ?? 'portrait');
        
        // Render the PDF
        $dompdf->render();

        // Stream or download the PDF
        return $dompdf->stream($fileName . '.pdf');
    }
}
