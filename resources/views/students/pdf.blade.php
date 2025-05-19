<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            color: #000;
            margin-left: 40px;
            margin-right: 40px;
            background: #fff;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        h1 {
            text-align: center;
            text-transform: uppercase;
            color: #1d4ed8;
            margin-bottom: 30px;
        }

        .section {
            margin-bottom: 30px;
        }

        .section h2 {
            color: #1d4ed8;
            font-size: 18px;
            margin-bottom: 10px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 4px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td, th {
            padding: 6px 10px;
            vertical-align: top;
        }

        th {
            text-align: left;
            width: 30%;
            background: #f0f0f0;
        }

        .profile-image {
            text-align: center;
            margin-bottom: 30px;
        }

        .profile-image img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 1px solid #ccc;
        }

        footer {
            text-align: center;
            font-size: 12px;
            color: #666;
            border-top: 1px solid #ccc;
            padding-top: 10px;
            margin-top: 40px;
        }
    </style>
</head>
<body>
    <div class="container">

        <h1>Student Profile</h1>

        <!-- Profile Image -->
        <div class="profile-image">
            <img src="{{ $model->photo ? public_path('storage/' . $model->photo) : '' }}" alt="Profile Photo">
        </div>

        <!-- Personal Info -->
        <div class="section">
            <h2>Personal Information</h2>
            <table>
                <tr><th>First Name</th><td>{{ $model->first_name }}</td></tr>
                <tr><th>Middle Name</th><td>{{ $model->middle_name }}</td></tr>
                <tr><th>Last Name</th><td>{{ $model->last_name }}</td></tr>
                <tr><th>Date of Birth</th><td>{{ $model->date_of_birth }}</td></tr>
                <tr><th>Gender</th><td>{{ $model->gender }}</td></tr>
                <tr><th>Marital Status</th><td>{{ $model->marital_status }}</td></tr>
                <tr><th>Email</th><td>{{ $model->email }}</td></tr>
            </table>
        </div>

        <!-- Birth Details -->
        <div class="section">
            <h2>Birth Details</h2>
            <table>
                <tr><th>Town</th><td>{{ $model->place_of_birth_town }}</td></tr>
                <tr><th>City</th><td>{{ $model->place_of_birth_city }}</td></tr>
                <tr><th>Country</th><td>{{ $model->place_of_birth_country }}</td></tr>
                <tr><th>Nationality</th><td>{{ $model->nationality }}</td></tr>
                <tr><th>Official Language</th><td>{{ $model->official_language }}</td></tr>
            </table>
        </div>

        <!-- Address -->
        <div class="section">
            <h2>Permanent Address</h2>
            <table>
                <tr><th>Town</th><td>{{ $model->permanent_address_town }}</td></tr>
                <tr><th>City</th><td>{{ $model->permanent_address_city }}</td></tr>
                <tr><th>Country</th><td>{{ $model->permanent_address_country }}</td></tr>
                <tr><th>Mobile Phone</th><td>{{ $model->mobile_phone }}</td></tr>
            </table>
        </div>

        <!-- Parent Info -->
        <div class="section">
            <h2>Parent Information</h2>
            <table>
                <tr><th>Father's Name</th><td>{{ $model->father_name }}</td></tr>
                <tr><th>Mother's Name</th><td>{{ $model->mother_name }}</td></tr>
            </table>
        </div>

        <!-- Emergency Contact -->
        <div class="section">
            <h2>Emergency Contact</h2>
            <table>
                <tr><th>Name</th><td>{{ $model->emergency_contact_name }}</td></tr>
                <tr><th>Number</th><td>{{ $model->emergency_contact_number }}</td></tr>
            </table>
        </div>

        <!-- Education -->
        <div class="section">
            <h2>Education</h2>
            <table>
                <tr><th>Computer Literacy</th><td>{{ $model->computer_literacy }}</td></tr>
                <tr><th>Education Status</th><td>{{ $model->education_status }}</td></tr>
            </table>
        </div>

        <!-- Enrollment -->
        <div class="section">
            <h2>Enrollment</h2>
            <table>
                <tr><th>Status</th><td>{{ ucfirst($model->status) }}</td></tr>
                <tr><th>New Student</th><td>{{ $model->is_new ? 'Yes' : 'No' }}</td></tr>
            </table>
        </div>

        <!-- Footer -->
        <footer>
            Printed on {{ \Carbon\Carbon::now()->format('F j, Y') }}
        </footer>
    </div>
</body>
</html>
