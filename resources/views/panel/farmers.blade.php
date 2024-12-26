<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farmers Panel</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Custom styles for the modal */
        .modal-content {
            background-color: green;
            color: white;
            
            width: 800px;
            height: 450px;
            padding: 20px;
        }
        .form-control {
            background-color: green;
            color: black;
            width: calc(100% - 20px);
        }
        .modal-header, .modal-footer {
            border: none;
        }
        .btn-search {
            background-color: yellowgreen;
            border-radius: 20%;
            color: white;
            width: 60px;
            height: 40px;
        }
        .btn-print {
            background-color: yellow;
            color: black;
            border-radius: 20%;
            width: 80px;
            
            height: 40px;
        }
        .btn-add {
            background-color: blue;
            color: white;
            border-radius: 20%;
            width: 60px;
            height: 40px;
        }
        .btn-edit {
            background-color: orange;
            color: white;
            border-radius: 20%;
            width: 60px;
            
            height: 40px;
        }
        .btn-delete {
            background-color: red;
            color: white;
            border-radius: 20%;
            width: 60px;
            height: 40px;
        }
        /* Table styles */
        .table-container {
            max-height: 750px;
            overflow-y: auto;
        }
        thead th {
            position: sticky;
            top: 0;
            background-color: green;
            color: white;
            z-index: 2;
        }
        tbody td {
            vertical-align: middle;
        }
        .header {
                text-align: center;
                margin-bottom: 20px;
            }
            .header img {
                width: 30px;
                height: 30px;
            }
            .no-print {
                display: none;
                
            }
    </style>
</head>
<body>

@extends('layouts.adminnav')
<div style="background-color:green; width:100%;position: fixed; color:white;"><h3 style="font-weight: bold; color:white; margin-left:2.80in;">FARMER LISTS</h3></div>
@section('content')
<div class="mb-3 d-flex justify-content-between" style="margin-top: 50px; ">
<div class="card" style="width: 3in; height:1in;">

<div class="card-body" style="background-color: white; color: black;justify-content: center; border: 5px solid green;border-color: green;">

    <h5 class="card-title align-items-center justify-content-center text-center">TOTAL FARMERS</h5>

    <h4 class="card-text align-items-center justify-content-center text-center">{{ $totalFarmers }}</h4>

</div>

</div>
    <form action="{{ route('farmers.search') }}" method="GET" class="d-flex">
        <p>_______________________________________________________</p>
        <input type="text" id="search" name="query" class="form-control black-textbox" placeholder="Search" required style="background-color: white; color:black; border: 1px solid black;">
        <button type="submit" class="btn-search ms-2">Search</button> 
        <button type="button" id="printButton" class="btn-print ms-2" onclick="printTable()">Print</button>
        <button class="btn-add ms-2" data-toggle="modal" data-target="#addFarmerModal">Add</button>
        <a href="{{ url('panel/user_registered') }}" class="btn" style="height: 40px; background-color:green; color:aquamarine; margin-left:10px;">RegisteredList</a>
        
    </form>
</div>

<!-- Add Farmer Modal -->
<div class="modal fade" id="addFarmerModal" tabindex="-1" role="dialog" aria-labelledby="addFarmerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addFarmerModalLabel">Add Farmer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('farmers.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="form-group">
    <label for="location">Location</label>
    <input type="text" class="form-control" id="location" name="location" placeholder="Enter location" required>
</div>

<div class="form-group">
                            <label for="phone_number">Phone Number</label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number" required maxlength="11" pattern="\d{11}" title="Please enter a valid 11-digit phone number">
                        </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="gmail_account">Gmail Account</label>
                                <input type="email" class="form-control" id="gmail_account" name="gmail_account" required>
                            </div>
                            <div class="form-group">
                                <label for="land_size">Land Size(HA)</label>
                                <input type="text" class="form-control" id="land_size" name="land_size" required>
                            </div>
                            <div class="form-group">
                                <label for="date">Date</label>
                                <input type="date" class="form-control" id="date" name="date" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-light">Add Farmer</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="container mt-4" style="border: 1px solid #000; padding: 20px; border-radius: 5px; background-color: #f9f9f9; width: 1000px; height: 400px;">
    <div class="table-container" style="overflow-y: auto; height: calc(100% - 20px);">
        <table class="table table-bordered" id="farmerTable" style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr class="table-light">
                    <th style="position: sticky; top: 0; background-color: #f9f9f9; z-index: 1;">Id</th>
                    <th style="position: sticky; top: 0; background-color: #f9f9f9; z-index: 1;">Name</th>
                    <th style="position: sticky; top: 0; background-color: #f9f9f9; z-index: 1;">Location</th>
                    <th style="position: sticky; top: 0; background-color: #f9f9f9; z-index: 1;">Phone Number</th>
                    <th style="position: sticky; top: 0; background-color: #f9f9f9; z-index: 1;">Gmail Account</th>
                    <th style="position: sticky; top: 0; background-color: #f9f9f9; z-index: 1;">Land Size (HC)</th>
                    <th style="position: sticky; top: 0; background-color: #f9f9f9; z-index: 1;">Date</th>
                    <th style="position: sticky; top: 0; background-color: #f9f9f9; z-index: 1;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($farmers as $farmer)
                <tr class="value">
                    <td>{{ $farmer->id }}</td>
                    <td>{{ $farmer->name }}</td>
                    <td>{{ $farmer->location }}</td>
                    <td>{{ $farmer->phone_number }}</td>
                    <td>{{ $farmer->gmail_account }}</td>
                    <td>{{ $farmer->land_size }}</td>
                    <td>{{ $farmer->date }}</td>
                    <td class="mb d-flex justify-content-between">
                        <button class="btn-edit btn-sm" data-bs-toggle="modal" data-bs-target="#editFarmerModal" 
                            data-id="{{ $farmer->id }}" 
                            data-name="{{ $farmer->name }}" 
                            data-location="{{ $farmer->location }}" 
                            data-phone_number="{{ $farmer->phone_number }}" 
                            data-gmail="{{ $farmer->gmail_account }}" 
                            data-landsize="{{ $farmer->land_size }}" 
                            data-date="{{ $farmer->date }}">
                            Edit
                        </button>
                        <form action="{{ route('farmers.destroy', $farmer->id) }}" method="POST" style="display: inline-block; margin-left: 10px;" onsubmit="return confirmDelete();">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>



<!-- Edit Farmer Modal -->
<div class="modal fade" id="editFarmerModal" tabindex="-1" aria-labelledby="editFarmerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="max-width: 800px;">
        <div class="modal-content" style="height: 450px;">
            <div class="modal-header">
                <h5 class="modal-title" id="editFarmerModalLabel">Edit Farmer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editFarmerForm" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="farmerId" name="farmerId">
                    
                    <!-- Form Layout -->
                    <div class="row">
                        <!-- Left Column -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="farmerName" class="form-label">Name</label>
                                <input type="text" class="form-control" id="farmerName" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="farmerLocation" class="form-label">Location</label>
                                <input type="text" class="form-control" id="farmerLocation" name="location" required>
                            </div>
                            <div class="mb-3">
                                <label for="farmerPhone" class="form-label">Phone Number</label>
                                <input type="text" class="form-control" id="phone_number" name="phone_number" required maxlength="11" pattern="\d{11}" title="Please enter a valid 11-digit phone number">
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="farmerGmail" class="form-label">Gmail Account</label>
                                <input type="email" class="form-control" id="farmerGmail" name="gmail_account" required>
                            </div>
                            <div class="mb-3">
                                <label for="farmerLandSize" class="form-label">Land Size</label>
                                <input type="text" class="form-control" id="farmerLandSize" name="land_size" required>
                            </div>
                            <div class="mb-3">
                                <label for="farmerDate" class="form-label">Date</label>
                                <input type="date" class="form-control" id="farmerDate" name="date" required>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




</div>
@endsection


<!-- Include Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
   function printTable() {
    const farmerTable = document.getElementById('farmerTable');
    const title = "FARMERS FEDERATION LIST"; 
    const rows = farmerTable.getElementsByTagName('tr');

    const printContent = `
        <html>
            <head>
                <title>${title}</title>
                <style>
                    @media print {
                        body { margin: 20px; font-family: Arial, sans-serif; }
                        table { width: 100%; border-collapse: collapse; }
                        th, td { border: 1px solid black; padding: 8px; text-align: left; }
                        h1, h2 { text-align: center; }
                        img { height: 50px; vertical-align: middle; margin-right: 10px; border-radius: 100%;}
                    }
                </style>
            </head>
            <body>
                <h2 ><img src="{{ asset('iMG/FARML.png') }}"  alt="">${title}</h2>
                <table>
                    <tbody>
                        ${Array.from(rows).map(row => `
                            <tr>
                                <td>${row.cells[0].textContent}</td>
                                <td>${row.cells[1].textContent}</td>
                                <td>${row.cells[2].textContent}</td>
                                <td>${row.cells[3].textContent}</td>
                                <td>${row.cells[4].textContent}</td>
                                <td>${row.cells[5].textContent}</td>
                                <td>${row.cells[6].textContent}</td>
                            </tr>
                        `).join('')}
                    </tbody>
                </table>
            </body>
        </html>
    `;

    // Open a new window for printing
    const printWindow = window.open('', '', 'height=600,width=800');
    printWindow.document.write(printContent);
    printWindow.document.close();
    printWindow.focus();
    printWindow.print();
    printWindow.close();
}

// JavaScript to populate the edit modal with the farmer's data



    $(document).ready(function() {

        $('.btn-edit').on('click', function() {

            // Get data attributes from the button

            const id = $(this).data('id');

            const name = $(this).data('name');

            const location = $(this).data('location');

            const phone_number = $(this).data('phone_number');

            const gmail = $(this).data('gmail');

            const landSize = $(this).data('landsize');

            const date = $(this).data('date');


            // Populate the modal fields

            $('#farmerId').val(id);

            $('#farmerName').val(name);

            $('#farmerLocation').val(location);

            $('#farmerPhone').val(phone_number);

            $('#farmerGmail').val(gmail);

            $('#farmerLandSize').val(landSize);

            $('#farmerDate').val(date);


            // Update the form action to point to the correct route

            $('#editFarmerForm').attr('action', '/farmers/' + id);

        });

    });

    function confirmDelete() {

return confirm("Are you sure you want to delete this farmer? This action cannot be undone.");

}

</script>
</body>
</html>