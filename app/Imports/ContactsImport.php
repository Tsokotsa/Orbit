<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\Contacts;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;


class ContactsImport implements ToModel, WithStartRow, WithValidation
{

    public function model(array $row)
    {

        return new Contacts([
            'name'          => $row[0],
            'surname'       => $row[1],
            'email'         => $row[2],
            'cell1'         => $row[3],
            'cell2'         => $row[4],
        ]);
    }

    public function startRow(): int
    {
        // Do not read headers of file
        return 2;
    }

    public function rules(): array
    {
        return [
            '3' => [
                'required',
                'integer',
                'digits:12',
                'regex:/^\d+$/',
            ],
            '0' => 'required|string|max:255',
            '1' => 'required|string|max:255',
            '2' => 'required|email|unique:contacts,email',
        ];
    }

    public function customValidationMessages()
    {
        return [
            '0.required' => 'Name is required',
            '1.required' => 'Surname is required',
            '2.required' => 'Email is required',
            '2.email' => 'Email must be a valid email address',
            '2.unique' => 'Email already exists in the database',
            '3.required' => 'Phone number is required',
            '3.integer' => 'Phone number must be an integer',
            '3.digits' => 'Phone number must be exactly 12 digits',
            '3.regex' => 'Phone number must not contain spaces',
        ];
    }

    public function onFailure(Failure $failures)
    {
        foreach ($failures as $failure) {

            // Log or handle validation failures
            // $failure->row(); // row that failed
            // $failure->attribute(); // field that failed
            // $failure->errors(); // errors related to the field
            // $failure->values(); // values of the row that failed
        }
    }
}
