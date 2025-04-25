<?php 

namespace App\Controllers;

use App\Models\EventModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class EventsController extends BaseController
{
    protected $model;
    
    public function __construct()
    {
        $this->model = new EventModel();

        helper('form');
    }

    public function index()
    {
        // Fetch all events from the database using the model
        $data['events'] = $this->model->findAll();
        
        return view('templates/header')
            .view('events/create', $data)
            .view('templates/footer');
    }
    
    public function create()
    {
        // Validate CSRF token
        if (!$this->request->is('post')) {
            return redirect()->back()->with('error', 'Invalid request method');
        }
        
        // Validate input data
        $rules = $this->model->validationRules;
                
        if (!$this->validate($rules)) {
            return redirect()->back()
                ->with('errors', $this->validator->getErrors())
                ->withInput();
        }
        
        // Note: When you use the validate() method, you should use the getValidated() method to get the validated data. 
        // Because the validate() method uses the Validation::withRequest() method internally, 
        // and it validates data from $request->getJSON() or $request->getRawInput() or $request->getVar(), 
        // and an attacker could change what data is validated.
        // Used $this->validator->getValidated() to retrieve only validated data, since v4.4.0. 
        // Not required to use $this->request->getPost('title', FILTER_SANITIZE_FULL_SPECIAL_CHARS - or - FILTER_SANITIZE_EMAIL) to get the data.
        // Get validated data
        $validData = $this->validator->getValidated();
        
        try {
            // Insert using Query Builder through Model
            if ($this->model->insert($data) === false) {
                throw new \RuntimeException('Failed to save event');
            }
            
            return redirect()->to('/events')
                ->with('message', 'Event created successfully');
                
        } catch (\Exception $e) {
            log_message('error', 'Event creation failed: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Failed to create event: '. $e->getMessage())
                ->withInput();
        }
    }
}