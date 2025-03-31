<?php
include("conn.php");
include("clogin.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <style>
        body {
            font-family: "Kanit", sans-serif;
            background-color: #121212; /* Dark background */
            margin: 0;
            padding: 20px;
            color: #fff; /* White text for the body */
        }

        .page-container {
            background-color: #1e1e1e; /* Dark container */
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.4); /* Red-tinted shadow */
            padding: 30px;
            border: 2px solidrgb(55, 0, 255); /* Dark red border */
        }

        h1 {
            color:rgb(255, 0, 221); /* Bright yellow */
            font-weight: 800;
            margin-bottom: 30px;
            border-bottom: 3px solid #c10000; /* Dark red */
            padding-bottom: 15px;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 2.5rem; /* Increased font size */
            text-shadow: 0 0 10px #ffdd00, 0 0 20px #ffdd00, 0 0 30px #ffdd00; /* Yellow glowing effect */
            animation: yellowGlow 1.5s ease-in-out infinite alternate;
        }

        @keyframes yellowGlow {
            from {
                text-shadow: 0 0 10px #ffdd00, 0 0 20px #ffdd00;
            }
            to {
                text-shadow: 0 0 15px #ffdd00, 0 0 25px #ffdd00, 0 0 35px #ffdd00, 0 0 45px #ffdd00;
            }
        }

        .form-control, .form-select {
            background-color:rgb(0, 174, 255);
            border-radius: 5px;
            border-color:rgb(0, 38, 255); /* Dark red */
            color: #fff;
        }

        .form-control:focus, .form-select:focus {
            background-color: #2a2a2a;
            border-color:rgb(24, 0, 245);
            box-shadow: 0 0 0 0.25rem rgba(9, 196, 209, 0.25);
            color: #fff;
        }

        .btn-primary {
            background-color:rgb(0, 225, 255); /* Dark red */
            border-color:rgb(5, 247, 235);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color:rgb(0, 174, 255); /* Bright red */
            border-color:rgb(252, 0, 155);
            transform: scale(1.05);
        }

        .btn-danger {
            background-color:rgb(0, 183, 255); /* Very dark red */
            border-color: #300000;
            transition: all 0.3s ease;
        }

        .btn-danger:hover {
            background-color:rgb(255, 0, 170);
            border-color: #500000;
            transform: scale(1.05);
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            color:rgb(2, 215, 243); /* Bright red */
            font-size: 0.9em;
        }

        .table {
            margin-top: 20px;
            color: #fff; /* White text for table */
        }

        .table thead {
            background-color:rgb(30, 126, 204); /* Dark red header */
            color: white;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #2a2a2a; /* Darker gray */
            color: #fff;
        }

        .table-striped tbody tr:nth-of-type(even) {
            background-color: #1e1e1e; /* Dark gray */
            color: #fff;
        }

        .table-hover tbody tr:hover {
            background-color:rgb(255, 0, 221); /* Very dark red hover */
            color: #fff;
        }

        .alert-success {
            background-color: #1e2e1e;
            color: #4CAF50;
            border-color: #4CAF50;
        }

        .alert-danger {
            background-color: #2e1e1e;
            color:rgb(36, 6, 170);
            border-color:rgb(96, 10, 255);
        }

        .alert-warning {
            background-color: #2e2e1e;
            color:rgb(241, 255, 233);
            border-color:rgb(245, 236, 211);
        }

        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter,
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_processing,
        .dataTables_wrapper .dataTables_paginate {
            color: #fff !important;
        }

        .dataTables_wrapper .dataTables_length select,
        .dataTables_wrapper .dataTables_filter input {
            background-color: #2a2a2a;
            color: #fff;
            border: 1px solidrgb(255, 0, 179);
        }

        .page-link {
            background-color: #2a2a2a;
            color:rgb(255, 24, 224);
            border-color: #c10000;
        }

        .page-link:hover {
            background-color:rgb(250, 13, 159);
            color: #fff;
        }

        .page-item.active .page-link {
            background-color:rgb(250, 0, 229);
            border-color: #900000;
        }

        /* ส่วนของ User Info Box */
        .user-info-container {
            margin-bottom: 25px;
        }
        
        .user-info-box {
            display: flex;
            align-items: center;
            background-color:rgb(4, 0, 255);
            border: 2px solidrgb(46, 9, 38);
            border-radius: 8px;
            padding: 12px 20px;
            margin: 20px 0;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        
        .user-info-title {
            font-weight: 600;
            color: #ffdd00;
            margin-right: 10px;
            white-space: nowrap;
        }
        
        .user-info-data {
            color: #fff;
            border-left: 2px solid #c10000;
            padding-left: 15px;
            margin-left: 5px;
        }

        .user-action-container {
            display: flex;
            justify-content: flex-end;
            margin-top: 15px;
        }

        @media (max-width: 768px) {
            .page-container {
                padding: 15px;
            }
            h1 {
                font-size: 2.2rem; /* Slightly smaller on mobile */
            }
        }

        @media (min-width: 992px) {
            h1 {
                font-size: 3.2rem; /* Even larger on desktops */
            }
        }
    </style>

    <title>ข้อมูลมอเตอร์ไซค์</title>
</head>

<body>
    <div class="container page-container">
        <?php
        if (isset($_GET['action_even']) && $_GET['action_even'] == 'delete') {
            $id = $_GET['id'];
            $sql = "SELECT * FROM motorcycles WHERE id=$id";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                $sql = "DELETE FROM motorcycles WHERE id=$id";

                if ($conn->query($sql) === TRUE) {
                    echo "<div class='alert alert-success text-center'>ลบข้อมูลสำเร็จ</div>";
                } else {
                    echo "<div class='alert alert-danger text-center'>ลบข้อมูลมีข้อผิดพลาด กรุณาตรวจสอบ !!! </div>" . $conn->error;
                }
            } else {
                echo "<div class='alert alert-warning text-center'>ไม่พบข้อมูล กรุณาตรวจสอบ</div>";
            }
        }
        ?>
        
        <div class="user-info-container">
            <h1 class="text-center">ข้อมูลมอเตอร์ไซค์</h1>
            
            <div class="user-info-box">
                <div class="user-info-title">ผู้เข้าสู่ระบบ :</div>
                <div class="user-info-data">พัฒนาโดย 664485038 นายธิติวุฒิ ศิริทรัพย์</div>
            </div>
            
            <div class="user-action-container">
                <a href="add_movie.php" class="btn btn-primary">เพิ่มมอเตอร์ไซค์
            </div>
        </div>

        <div class="table-responsive">
            <table id="example" class="table table-striped table-hover">
                <thead>
                    <tr>
                    <th>id</th>
                    <th>ยี่ห้อ</th>
                    <th>รุ่น</th>
                    <th>ปี</th>
                    <th>สี</th>
                    <th>จำนวนCC</th>
                    <th>ราคา</th>
                    <th>แก้ไขข้อมูล</th>
                    
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM motorcycles";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["id"] . "</td>";
                            echo "<td>" . $row["brand"] . "</td>";
                            echo "<td>" . $row["model"] . "</td>";
                            echo "<td>" . $row["year"] . "</td>";
                            echo "<td>" . $row["color"] . "</td>";
                            echo "<td>" . $row["engine_size"] . "</td>";
                            echo "<td>" . $row["price"] . "</td>";
                         
                            echo '<td>
                                <div class="btn-group" role="group">
                                    <a href="show.php?action_even=delete&id=' . $row['id'] . '" 
                                       class="btn btn-danger btn-sm"
                                       onclick="return confirm(\'ต้องการจะลบข้อมูลการจอง ' . $row['id'] . ' มอเตอร์ไซค์ ' . $row['brand'] . ' ของคุณ ' . $row['model'] . '?\')"
                                    >
                                       ลบข้อมูล
                                    </a>
                                    <a href="edit_movie.php?action_even=edit&id=' . $row['id'] . '" 
                                       class="btn btn-primary btn-sm"
                                       onclick="return confirm(\'ต้องการจะแก้ไขข้อมูลการจอง ' . $row['id'] . ' มอเตอร์ไซค์ ' . $row['brand'] . ' ของคุณ ' . $row['model'] . '?\')"
                                    >
                                       แก้ไขข้อมูล
                                    </a>
                                </div>
                            </td>';
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8' class='text-center'>0 results</td></tr>";
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>

        <div class="footer mt-4">
            
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery and DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

    <script>
        new DataTable('#example', {
            language: {
                search: 'ค้นหา:',
                lengthMenu: 'แสดง _MENU_ รายการ',
                info: 'หน้า _PAGE_ จาก _PAGES_',
                infoEmpty: 'ไม่มีข้อมูล',
                zeroRecords: 'ไม่พบข้อมูล',
                paginate: {
                    first: 'หน้าแรก',
                    last: 'หน้าสุดท้าย',
                    next: 'ถัดไป',
                    previous: 'ก่อนหน้า'
                }
            }
        });
    </script>
</body>
</html>