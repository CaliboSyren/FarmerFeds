@extends('layouts.adminnav')

<div style="background-color:green; width:100%;position: fixed; color:white;">
    <h3 style="font-weight: bold; color:white; margin-left:2.80in;">RESOURCES ALLOCATION LISTS</h3>
</div>
@section('content')
<div class="container" style="margin-top: 50px;">
    <!-- Success message -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <!-- Filter Section -->
    <form  id="filterForm"  method="GET" action="{{ route('panel.resources') }}" class="mb-4">
        <div class="row">
            <div class="col-md-2">
                <p style="font-weight: bold;">From</p><input type="date" name="from" class="form-control" placeholder="From" value="{{ request('from') }}">
            </div>
            <div class="col-md-2">
            <p style="font-weight: bold;">To</p><input type="date" name="to" class="form-control" placeholder="To" value="{{ request('to') }}">
            </div>
            <div class="col-md-2" style="margin-top: 40px;">
                <select name="resource_type" class="form-control" >
                    <option value="">Select Resource Type</option>
                    <option value="Fertilizer" {{ request('resource_type') == 'Fertilizer' ? 'selected' : '' }}>Fertilizer</option>
                    <option value="Binhi" {{ request('resource_type') == 'Binhi' ? 'selected' : '' }}>Binhi</option>
                    <option value="Sprayer" {{ request('resource_type') == 'Sprayer' ? 'selected' : '' }}>Sprayer</option>
                    <option value="Tools" {{ request('resource_type') == 'Tools' ? 'selected' : '' }}>Tools</option>
                </select>
            </div>
            <div class="col-md-3" style="margin-top: 40px;">
                <button type="submit" class="btn btn-primary"style="color: black;background-color:yellowgreen;">Filter</button>
            </div>
        </div>
    </form>
    <!-- Add Resource Allocation -->
    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addResourceModal" style="color: aqua;background-color:green;">Add Resource</button>
    <button class="btn btn-success mb-3" onclick="printTableAndGraph()" style="color:yellow;background-color:green;">Print Report</button>
    <a href="{{ url('panel/inventory') }}" class="btn btn-success mb-3" style="color: white; background-color: green;">Go to Inventory</a>
    <!-- Resource Allocation Table -->
<div class="card shadow-lg" style="border-color: black;">
    <div class="card-body">
        <h5 class="card-title">Resource Allocation</h5>
        <div class="table-responsive" style="height: 400px;">
            <table id="resourceTable" class="table table-bordered">
                <thead style="position: sticky; top: 0; background-color: #f8f9fa;">
                    <tr>
                        <th>Farmer Name</th>
                        <th>Resource</th>
                        <th>Date</th>
                        <th>Quantity</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($allocations as $allocation)
                        <tr>
                            <td>{{ $allocation->farmer->name }}</td>
                            <td>{{ $allocation->resource }}</td>
                            <td>{{ $allocation->date }}</td>
                            <td>{{ $allocation->quantity }}</td>
                            <td class="d-flex justify-content-center" style="margin-top:20px;">
                                <!-- Edit Button -->
                                <button class="btn btn-sm btn-warning" style="background-color: orange; color: white; border: 2px solid white; border-radius: 12%; width: 60px; height: 44px; font-size: medium;"
        data-bs-toggle="modal" data-bs-target="#editResourceModal"
        data-id="{{ $allocation->id }}"
        data-farmer-id="{{ $allocation->farmer_id }}"
        data-resource="{{ $allocation->resource }}"
        data-date="{{ $allocation->date }}"
        data-quantity="{{ $allocation->quantity }}">
        Edit
    </button>
                                
                                <!-- Delete Button -->
                                <form method="POST" action="{{ route('panel.resources.destroy', $allocation->id) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this allocation?');">
                Delete
            </button>
        </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
    <!-- Line Chart -->
    <div class="mt-5">
        <div class="d-flex justify-content-between align-items-center">
            <h3 style="font-weight: bold;">Resource Visual Distribution</h3>
            <select id="graphView" class="form-select w-auto">
                <option value="day" selected>Day</option>
                <option value="month">Month</option>
                <option value="year">Year</option>
            </select>
        </div>
        <canvas id="resourceChart" class="mt-3"></canvas>
    </div>
</div>
<!-- Add Resource Modal -->
<div class="modal fade" id="addResourceModal" tabindex="-1" aria-labelledby="addResourceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('panel.resources.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addResourceModalLabel">Add Resource Allocation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if($errors->any())
                        <div class="alert alert-danger">{{ $errors->first() }}</div>
                    @endif
                    <div class="mb-3">
                        <label for="farmer_id" class="form-label">Farmer</label>
                        <select name="farmer_id" id="farmer_id" class="form-control" required>
                            @foreach($farmers as $farmer)
                                <option value="{{ $farmer->id }}">{{ $farmer->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="resource7" class="form-label">Available Resources</label>
                        <select name="resource6" id="resource5" class="form-control">
                            @foreach($resources as $resource)
                                <option value="{{ $resource->resource }}">
                                    {{ $resource->name }} ({{ $resource->quantity }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="resource" class="form-label">Resource Name</label>
                        <input type="text" name="resource" id="resource" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" name="date" id="date" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" name="quantity" id="quantity" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--Edit-->
<div class="modal fade" id="editResourceModal" tabindex="-1" aria-labelledby="editResourceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" id="editResourceForm" action="">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editResourceModalLabel">Edit Resource Allocation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="farmer" class="form-label">Farmer</label>
                        <input type="text" class="form-control" id="farmer" name="farmer" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="resource" class="form-label">Resource</label>
                        <select name="resource" id="resource" class="form-control" required>
                            <option value="Fertilizer">Fertilizer</option>
                            <option value="Binhi">Binhi</option>
                            <option value="Sprayer">Sprayer</option>
                            <option value="Tools">Tools</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" name="date" id="date" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" name="quantity" id="quantity" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.querySelectorAll('.btn-edit').forEach(button => {
button.addEventListener('click', function () {
    // Get the data attributes from the button
    const farmerId = this.getAttribute('data-far mer-id');
    const farmerName = this.getAttribute('data-farmer');
    const resource = this.getAttribute('data-resource');
    const date = this.getAttribute('data-date');
    const quantity = this.getAttribute('data-quantity');
    const allocationId = this.getAttribute('data-id');
    // Set the data into the modal form
    document.getElementById('farmer').value = farmerName;
    document.getElementById('resource').value = resource;
    document.getElementById('date').value = date;
    document.getElementById('quantity').value = quantity;
    // Set the form action to the correct URL for updatig the resource allocation
    const formAction = `/panel/resources/${allocationId}`;
    document.getElementById('editResourceForm').action = formAction;
});
});
 let chart;
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('resourceChart').getContext('2d');
        function fetchData(view = 'day') {
            fetch(`{{ route('panel.resources.graph-data') }}?view=${view}`)
                .then(response => response.json())
                .then(data => {
                    const labels = [...new Set(data.map(item => item.label))];
                    const datasets = [];
                    const resources = [...new Set(data.map(item => item.resource))];
                    resources.forEach(resource => {
                        const resourceData = labels.map(label => {
                            const item = data.find(d => d.label === label && d.resource === resource);
                            return item ? item.total_quantity : 0;
                        });
                        datasets.push({
                            label: resource,
                            data: resourceData,
                            borderColor: getRandomColor(),
                            fill: false,
                        });
                    });
                    if (chart) chart.destroy();
                    chart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: labels,
                            datasets: datasets,
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: { position: 'top' },
                                tooltip: { mode: 'index', intersect: false },
                            },
                            scales: {
                                x: { title: { display: true, text: view } },
                                y: { title: { display: true, text: 'Quantity' }, beginAtZero: true },
                            },
                        },
                    });
                });
        }
        function getRandomColor() {
            return `rgba(${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, 0.7)`;
        }
        fetchData();
        document.getElementById('graphView').addEventListener('change', function () {
            fetchData(this.value);
        });
    });
    function printTableAndGraph(){
    const resourceTable = document.getElementById('resourceTable');  
    const chartImage = chart.toBase64Image();
    const title = "RESOURCES ALLOCATION LIST"; 
    const rows = resourceTable.getElementsByTagName('tr');
    const printContent = `
        <html>
            <head>
                <title>${title}</title>
                <style>
                    @media print {
                        body { margin: 20px; font-family: Arial, sans-serif; }
                        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
                        th, td{ border: 1px solid black; padding: 8px; text-align: left; }
                        h1, h2 { text-align: center; }   
                    }
                </style>
            </head>
            <body>
                <h2><img src="{{ asset('iMG/FARML.png') }}" alt="" style="height: 50px; vertical-align: middle; margin-right: 10px; border-radius: 100%;">${title}</h2>
                <table>
                    <thead>
                    </thead>
                    <tbody>
                        ${Array.from(rows).map(row => 
                            `<tr>
                                <td>${row.cells[0].textContent}</td>
                                <td>${row.cells[1].textContent}</td>
                                <td>${row.cells[2].textContent}</td>
                                <td>${row.cells[3].textContent}</td>
                            </tr>`
                        ).join('')}
                    </tbody>
                </table>
                <h2>Resource Distribution Chart</h2>
                <img src="${chartImage}" style="height:500px; width:700px;" />
            </body>
        </html>
    `;
    // Open a new window for printing
    const printWindow = window.open('', '_blank');
    printWindow.document.write(printContent);
    printWindow.document.close();
    printWindow.print();
}
// Confirm Deletion
function confirmDelete() {
        return confirm("Are you sure you want to delete this record?");
    }
    // const editButtons = document.querySelectorAll('.btn-edit');
    // editButtons.forEach(button => {
    //     button.addEventListener('click', function() {
    //         const id = this.getAttribute('data-id');
    //         const farmerName = this.getAttribute('data-farmer');
    //         const farmerId = this.getAttribute('data-farmer-id'); 
    //         const resource = this.getAttribute('data-resource');
    //         const date = this.getAttribute('data-date');
    //         const quantity = this.getAttribute('data-quantity');            
    //         document.getElementById('farmer').value = farmerName;
    //         document.getElementById('farmer_id').value = farmerId;
    //         document.getElementById('resource').value = resource;
    //         document.getElementById('date').value = date;
    //         document.getElementById('quantity').value = quantity;
    //         document.getElementById('editResourceForm').action = `/resources/${id}`;
    //     });
    // });

    document.addEventListener('DOMContentLoaded', function () {
    // Event listener for opening the modal
    $('#editResourceModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var farmer = button.data('farmer'); // Extract data-* attributes
        var resource = button.data('resource');
        var date = button.data('date');
        var quantity = button.data('quantity');
        var id = button.data('id');
        
        // Populate modal fields with the data
        var modal = $(this);
        modal.find('#farmer').val(farmer);
        modal.find('#resource').val(resource);
        modal.find('#date').val(date);
        modal.find('#quantity').val(quantity);
        
        // Set the form action to the appropriate update route
        var formAction = '/resources/' + id;  // Adjust the URL to match your update route
        modal.find('#editResourceForm').attr('action', formAction);
    });
});
</script>
@endsection
