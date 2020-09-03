<?php

namespace App\Http\Controllers;

use App\Contact;
use App\CustomAttribute;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use League\Csv\Exception;
use League\Csv\Reader;
use League\Csv\Statement;

/**
 * CSV Field Import Mapper
 */
class ContactController extends Controller
{
    /**
     * Contact index page
     */
    public function index()
    {
       return view('contacts.index', [
           'contacts' => Contact::paginate(20)
       ]);
    }

     /**
      *  Render the component
      */
     public function importer()
     {
         return view('contacts.importer');
     }

     /**
      * Read the file and get the header
      */
     public function uploadFile(Request $request)
     {
        // process the uploaded file and redirect to next method for matching fields
        $file = $request->file;

        $fileName = time().$file->getClientOriginalName();

        Storage::disk('local')->putFileAs(
            'files',
            $file,
            $fileName
          );

        $filePath = storage_path() . '/app/files/' . $fileName;

        try {
            $csvReader = Reader::createFromPath($filePath, 'r');

            $csvReader->setHeaderOffset(0);
            $headerOffset = $csvReader->getHeaderOffset(); //returns 0

            $headers = $csvReader->getHeader();

            return response()->json([
                'headers' => $headers,
                'file_name' => $fileName
            ]);

        } catch (Exception $e) {
            dump($e->getMessage());
        }
     }

     /**
      * Process and store the contacts from the file....
      */
     public function storeContacts(Request $request)
     {
        $fileName = $request->get('file_name');
        $teamId   = $request->get('team_id');
        $mapped   = $request->get('mapped', null);

        $filePath = storage_path() . '/app/files/' . $fileName;

        try {
            $csvReader = Reader::createFromPath($filePath, 'r');
            $csvReader->setHeaderOffset(0);
            
            $records = Statement::create()->process($csvReader);
            
            foreach ($records as $record) {
                $contact = [];
                $customAttrs = [];

                // Search coincidence
                foreach ($mapped as $mapField) {

                    if (isset($record[$mapField['original']])) {
                        $contact[$mapField['imported']] = $record[$mapField['original']];

                        unset($record[$mapField['original']]);
                    }
                }

                // prepare to insert the mapped one
                $contact['team_id']    = $teamId;
                $contact['created_at'] = Carbon::now();
                $contact['updated_at'] = Carbon::now();

                $contact = Contact::create($contact);

                // with the result object now insert the extra fields
                foreach($record as $key => $value) {

                    $customAttrs[] = [
                        'contact_id' => $contact->id,
                        'key' => $key,
                        'value' => $value
                    ];
                }

                CustomAttribute::insert($customAttrs);
            }

            // Delete file
            unlink($filePath);

            // when done, return a 200 response to Vue...
            return response()->json([
                'contacts' => Contact::count()
            ]);

        } catch (Exception $e) {
            return response()->json([
                'error_message' => $e->getMessage()
            ], 400);
        }

     }
}
