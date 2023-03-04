<?php
    $servername = "";
    $username = "";
    $password = "";
    try {
        $conn = new PDO("mysql:host=$servername;", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected successfully"."</br>";
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage()."</br>";;
    }
    try {
        $querys = array("CREATE DATABASE findmybus", 
                        "CREATE TABLE findmybus.buses (
                            BusId int NOT NULL AUTO_INCREMENT,
                            BusNumber varchar(50) NOT NULL,
                            BusType varchar(50) NOT NULL,
                            TotalSeats int NOT NULL,
                            EngineNo varchar(100) NOT NULL,
                            InsuranceNo varchar(100) NOT NULL,
                            PRIMARY KEY (BusId));", 
                        "CREATE TABLE findmybus.busstop (
                            StopId int NOT NULL,
                            StopName varchar(50) NOT NULL,
                            Address1 varchar(225) NOT NULL,
                            Address2 varchar(225) NOT NULL,
                            City varchar(225) NOT NULL,
                            State varchar(225) NOT NULL,
                            WorkPhoneNo varchar(11) NOT NULL,
                            SecondPhoneNo varchar(11) DEFAULT NULL,
                            PRIMARY KEY (StopId));",
                            "CREATE TABLE findmybus.depo (
                                depo_id int NOT NULL,
                                depo_name varchar(50) NOT NULL,
                                depo_no_of_platforms int NOT NULL,
                                depo_add varchar(50) NOT NULL,
                                depo_phone_1 varchar(11) NOT NULL,
                                depo_phone_2 varchar(11) DEFAULT NULL,
                                PRIMARY KEY (depo_id));",
                            "CREATE TABLE findmybus.route (
                                route_id int NOT NULL,
                                route_name varchar(50) NOT NULL,
                                route_start_location varchar(100) NOT NULL,
                                route_end_location varchar(100) NOT NULL,
                                PRIMARY KEY (route_id));",
                            "CREATE TABLE findmybus.staff (
                                StaffId int NOT NULL,
                                StaffType varchar(20) NOT NULL,
                                FirstName varchar(20) NOT NULL,
                                LastName varchar(20) NOT NULL,
                                DOB date NOT NULL,
                                JoiningDate date NOT NULL,
                                RetirementDate date NOT NULL,
                                Address1 varchar(255) NOT NULL,
                                Address2 varchar(255) NOT NULL,
                                City varchar(255) NOT NULL,
                                State varchar(255) NOT NULL,
                                PinCode varchar(10) NOT NULL,
                                AddarCardNo varchar(12) NOT NULL,
                                AddarCardURL varchar(255) NOT NULL,
                                ProfilePhotoURL varchar(255) NOT NULL,
                                LicenceNo varchar(50) NOT NULL,
                                LicenceURL varchar(255) NOT NULL,
                                WorkPhoneNo varchar(11) NOT NULL,
                                HomePhoneNo varchar(11) DEFAULT NULL,
                                PRIMARY KEY (StaffId));",
                                "CREATE TABLE findmybus.busschedule (
                                    trip_id varchar(10) NOT NULL,
                                    route_id int NOT NULL,
                                    driver_id int NOT NULL,
                                    conductor_id int NOT NULL,
                                    bus_id int NOT NULL,
                                    PRIMARY KEY (trip_id),
                                    KEY route_id (route_id),
                                    KEY driver_id (driver_id),
                                    KEY conductor_id (conductor_id),
                                    CONSTRAINT busschedule_ibfk_1 FOREIGN KEY (route_id) REFERENCES route (route_id),
                                    CONSTRAINT busschedule_ibfk_2 FOREIGN KEY (driver_id) REFERENCES staff (StaffId),
                                    CONSTRAINT busschedule_ibfk_3 FOREIGN KEY (conductor_id) REFERENCES staff (StaffId),
                                    CONSTRAINT busschedule_ibfk_4 FOREIGN KEY (conductor_id) REFERENCES buses (BusId));",
                                "CREATE TABLE findmybus.adminuser (
                                    admin_id varchar(6) NOT NULL,
                                    pass int NOT NULL,
                                    PRIMARY KEY (admin_id));"
                    );
        foreach ($querys as $query) {
            $conn->exec($query);
        }
        echo "Database AND table created successfully"."</br>";
        $querys = array("INSERT INTO findmybus.buses (BusNumber, BusType, TotalSeats, EngineNo, InsuranceNo)
                        VALUES
                        ('ABC-123', 'Sleeper', 40, 'ENG123', 'INS123'),
                        ('DEF-456', 'Seater', 30, 'ENG456', 'INS456'),
                        ('GHI-789', 'Sleeper', 40, 'ENG789', 'INS789'),
                        ('JKL-012', 'Seater', 30, 'ENG012', 'INS012'),
                        ('MNO-345', 'Sleeper', 40, 'ENG345', 'INS345'),
                        ('PQR-678', 'Seater', 30, 'ENG678', 'INS678'),
                        ('STU-901', 'Sleeper', 40, 'ENG901', 'INS901'),
                        ('VWX-234', 'Seater', 30, 'ENG234', 'INS234'),
                        ('YZA-567', 'Sleeper', 40, 'ENG567', 'INS567'),
                        ('BCD-890', 'Seater', 30, 'ENG890', 'INS890'),
                        ('EFG-123', 'Sleeper', 40, 'ENG123', 'INS123'),
                        ('HIJ-456', 'Seater', 30, 'ENG456', 'INS456'),
                        ('KLM-789', 'Sleeper', 40, 'ENG789', 'INS789'),
                        ('NOP-012', 'Seater', 30, 'ENG012', 'INS012'),
                        ('QRS-345', 'Sleeper', 40, 'ENG345', 'INS345'),
                        ('TUV-678', 'Seater', 30, 'ENG678', 'INS678'),
                        ('WXY-901', 'Sleeper', 40, 'ENG901', 'INS901'),
                        ('ZAB-234', 'Seater', 30, 'ENG234', 'INS234'),
                        ('CDE-567', 'Sleeper', 40, 'ENG567', 'INS567'),
                        ('FGH-890', 'Seater', 30, 'ENG890', 'INS890');",
                        "INSERT INTO findmybus.busstop (StopId, StopName, Address1, Address2, City, State, WorkPhoneNo, SecondPhoneNo)
                        VALUES
                        (1, 'Ahmedabad Central Bus Station', 'Geeta Mandir Road', 'Geeta Mandir', 'Ahmedabad', 'Gujarat', '25546 04342', ''),
                        (2, 'Baroda Central Bus Station', 'Kashivishwanath Temple Road', 'Pratapnagar', 'Vadodara', 'Gujarat', '52279 22540', ''),
                        (3, 'Bhavnagar Bus Station', 'Shravan Road', 'Bhavnagar', 'Bhavnagar', 'Gujarat', '82453 28348', ''),
                        (4, 'Gandhidham Bus Station', 'Station Road', 'Gandhidham', 'Kutch', 'Gujarat', '62216 44631', ''),
                        (5, 'Gandhinagar Bus Station', 'Swaminarayan Marg', 'Sector 11', 'Gandhinagar', 'Gujarat', '24322 52500', ''),
                        (6, 'Jamnagar Bus Station', 'Pandit Nehru Marg', 'Digvijay Plot', 'Jamnagar', 'Gujarat', '25445 02311', ''),
                        (7, 'Junagadh Bus Station', 'Shiuli Road', 'Junagadh', 'Junagadh', 'Gujarat', '28624 36355', ''),
                        (8, 'Mehsana Bus Station', 'Ambika Nagar', 'Mehsana', 'Mehsana', 'Gujarat', '24554 8000', ''),
                        (9, 'Navsari Bus Station', 'Station Road', 'Navsari', 'Navsari', 'Gujarat', '92549 57601', ''),
                        (10, 'Porbandar Bus Station', 'S T Road', 'Porbandar', 'Porbandar', 'Gujarat', '22224 22124', ''),
                        (11, 'Rajkot Central Bus Station', 'Gondal Road', 'Rajkot', 'Rajkot', 'Gujarat', '82385 04285', ''),
                        (12, 'Surat Central Bus Station', 'Varachha Road', 'Surat', 'Surat', 'Gujarat', '32939 84874', ''),
                        (13, 'Surendranagar Bus Station', 'M.G. Road', 'Surendranagar', 'Surendranagar', 'Gujarat', '22724 37227', ''),
                        (14, 'Vadnagar Bus Station', 'Modhera Road', 'Vadnagar', 'Mehsana', 'Gujarat', '22313 23012', ''),
                        (15, 'Valsad Bus Station', 'Nanakwada Road', 'Valsad', 'Valsad', 'Gujarat', '29253 18025', '');",
                        "INSERT INTO findmybus.depo (depo_id, depo_name, depo_no_of_platforms, depo_add, depo_phone_1, depo_phone_2)
                        VALUES
                        (1, 'Ahmedabad Bus Depo', 4, 'Gheekanta, Ahmedabad, Gujarat', '25506 54477', NULL),
                        (2, 'Surat Bus Depo', 6, 'Udhana Darwaja, Surat, Gujarat', '82612 42224', '92612 22285'),
                        (3, 'Vadodara Bus Depo', 5, 'Central Bus Station, Vadodara, Gujarat', '42652 72285', NULL),
                        (4, 'Rajkot Bus Depo', 3, 'Gondal Road, Rajkot, Gujarat', '28123 86155', '42812 38195'),
                        (5, 'Bhavnagar Bus Depo', 2, 'Kalanala, Bhavnagar, Gujarat', '27824 24378', NULL),
                        (6, 'Jamnagar Bus Depo', 3, 'Bedi Road, Jamnagar, Gujarat', '28827 50303', NULL),
                        (7, 'Junagadh Bus Depo', 2, 'Sardar Baug, Junagadh, Gujarat', '28526 24256', '28526 23456'),
                        (8, 'Anand Bus Depo', 2, 'Borsad Chokdi, Anand, Gujarat', '26922 46038', NULL),
                        (9, 'Porbandar Bus Depo', 2, 'Porbandar, Gujarat', '28622 41266', NULL),
                        (10, 'Navsari Bus Depo', 3, 'Navsari, Gujarat', '26372 50240', '26372 58611'),
                        (11, 'Mehsana Bus Depo', 3, 'Bhandu, Mehsana, Gujarat', '27622 59877', NULL),
                        (12, 'Bhuj Bus Depo', 2, 'Bhuj, Kutch, Gujarat', '28322 50065', NULL),
                        (13, 'Anjar Bus Depo', 2, 'Anjar, Kutch, Gujarat', '28364 21433', NULL),
                        (14, 'Amreli Bus Depo', 2, 'Amreli, Gujarat', '27922 23333', NULL),
                        (15, 'Botad Bus Depo', 1, 'Botad, Gujarat', '28492 41048', NULL),
                        (16, 'Dahod Bus Depo', 2, 'Dahod, Gujarat', '26732 20397', '26732 20292'),
                        (17, 'Godhra Bus Depo', 2, 'Godhra, Gujarat', '26722 42413', '26722 42202'),
                        (18, 'Nadiad Bus Depo', 3, 'Nadiad, Gujarat', '2682 563300', NULL),
                        (19, 'Morbi Bus Depo', 2, 'Morbi, Gujarat', '28222 31500', NULL),
                        (20, 'Surendranagar Bus Depo', 2, 'Surendranagar, Gujarat', '27522 32424', '27522 31256');",
                        "INSERT INTO findmybus.route (route_id, route_name, route_start_location, route_end_location)
                        VALUES 
                        (1, 'Ahmedabad-Mehsana Expressway', 'Ahmedabad', 'Mehsana'),
                        (2, 'Surat-Baroda Highway', 'Surat', 'Vadodara'),
                        (3, 'Rajkot-Jamnagar Highway', 'Rajkot', 'Jamnagar'),
                        (4, 'Gujarat State Highway 68', 'Palanpur', 'Deesa'),
                        (5, 'Ahmedabad-Rajkot Highway', 'Ahmedabad', 'Rajkot'),
                        (6, 'Gujarat State Highway 41', 'Vadodara', 'Halol'),
                        (7, 'Gujarat State Highway 151', 'Surat', 'Bardoli'),
                        (8, 'Gujarat State Highway 6', 'Navsari', 'Vansda'),
                        (9, 'Gujarat State Highway 141', 'Palitana', 'Amreli'),
                        (10, 'Gujarat State Highway 25', 'Bhuj', 'Mandvi'),
                        (11, 'Gujarat State Highway 20', 'Anand', 'Petlad'),
                        (12, 'Gujarat State Highway 40', 'Bhavnagar', 'Talaja'),
                        (13, 'Gujarat State Highway 72', 'Valsad', 'Dharampur'),
                        (14, 'Gujarat State Highway 10', 'Junagadh', 'Somanath'),
                        (15, 'Gujarat State Highway 33', 'Himmatnagar', 'Modasa'),
                        (16, 'Gujarat State Highway 12', 'Godhra', 'Halol'),
                        (17, 'Gujarat State Highway 64', 'Surendranagar', 'Dhrangadhra'),
                        (18, 'Gujarat State Highway 13', 'Amreli', 'Savarkundla'),
                        (19, 'Gujarat State Highway 5', 'Porbandar', 'Dwarka'),
                        (20, 'Gujarat State Highway 163', 'Bharuch', 'Ankleshwar');",
                        "INSERT INTO findmybus.staff (StaffId, StaffType, FirstName, LastName, DOB, JoiningDate, RetirementDate, Address1, Address2, City, State, PinCode, AddarCardNo, AddarCardURL, ProfilePhotoURL, LicenceNo, LicenceURL, WorkPhoneNo, HomePhoneNo) 
                        VALUES
                        (1, 'driver', 'Amit', 'Shah', '1985-06-02', '2010-05-01', '2055-05-01', '123 Main St', 'Apt 1', 'Ahmedabad', 'Gujarat', '380001', '123456789012', 'staffdata/aadharCardImg/aadhar.jpg', 'staffdata/prifilePhotos/photo.jpg', 'DL1234567', 'staffdata/licenses/license.jpg', '9876543210', '1234567890'),
                        (2, 'conductor', 'Pooja', 'Patel', '1990-09-12', '2015-03-15', '2065-03-15', '456 Elm St', '', 'Surat', 'Gujarat', '395001', '234567890123', 'staffdata/aadharCardImg/aadhar.jpg', 'staffdata/prifilePhotos/photo.jpg', 'DL2345678', 'staffdata/licenses/license.jpg', '9876543211', NULL),
                        (3, 'driver', 'Rajesh', 'Yadav', '1988-01-17', '2011-08-01', '2056-08-01', '789 Oak St', 'Apt 2', 'Vadodara', 'Gujarat', '390001', '345678901234', 'staffdata/aadharCardImg/aadhar.jpg', 'staffdata/prifilePhotos/photo.jpg', 'DL3456789', 'staffdata/licenses/license.jpg', '9876543212', '1234567891'),
                        (4, 'conductor', 'Neha', 'Sharma', '1995-11-30', '2016-12-01', '2066-12-01', '1010 Pine St', '', 'Rajkot', 'Gujarat', '360001', '456789012345', 'staffdata/aadharCardImg/aadhar.jpg', 'staffdata/prifilePhotos/photo.jpg', 'DL4567890', 'staffdata/licenses/license.jpg', '9876543213', NULL),
                        (5, 'driver', 'Sanjay', 'Gupta', '1986-03-05', '2012-10-01', '2057-10-01', '111 Main St', 'Apt 3', 'Surat', 'Gujarat', '395001', '567890123456', 'staffdata/aadharCardImg/aadhar.jpg', 'staffdata/prifilePhotos/photo.jpg', 'DL5678901', 'staffdata/licenses/license.jpg', '9876543214', '1234567892'),
                        (6, 'conductor', 'Aarav', 'Patel', '1990-05-12', '2015-01-01', '2050-12-31', '123 Main St', 'Apt 1', 'Ahmedabad', 'Gujarat', '380001', '123456789012', 'staffdata/aadharCardImg/aadhaar1.jpg', 'staffdata/prifilePhotos/photo.jpg', 'DL1234', 'staffdata/licenses/license.jpg', '9876543210', '1234567890'),
                        (7, 'driver', 'Aryan', 'Shah', '1992-07-18', '2016-02-01', '2051-01-31', '456 Elm St', 'Unit 2', 'Surat', 'Gujarat', '395007', '234567890123', 'staffdata/aadharCardImg/aadhaar2.jpg', 'staffdata/prifilePhotos/photo.jpg', 'DL2345', 'staffdata/licenses/license.jpg', '9876543211', '1234567891'),
                        (8, 'conductor', 'Ishaan', 'Pandey', '1985-09-20', '2009-01-01', '2044-12-31', '789 Oak St', 'Suite 3', 'Vadodara', 'Gujarat', '390001', '345678901234', 'staffdata/aadharCardImg/aadhaar3.jpg', 'staffdata/prifilePhotos/photo.jpg', 'DL3456', 'staffdata/licenses/license.jpg', '9876543212', '1234567892'),
                        (9, 'driver', 'Kabir', 'Desai', '1987-11-15', '2013-05-01', '2048-04-30', '1010 Pine St', 'Floor 4', 'Rajkot', 'Gujarat', '360001', '456789012345', 'staffdata/aadharCardImg/aadhaar4.jpg', 'staffdata/prifilePhotos/photo.jpg', 'DL4567', 'staffdata/licenses/license.jpg', '9876543213', '1234567893'),
                        (10, 'conductor', 'Rohan', 'Gupta', '1989-01-25', '2014-07-01', '2049-06-30', '111 Maple St', 'Suite 5', 'Jamnagar', 'Gujarat', '361001', '567890123456', 'staffdata/aadharCardImg/aadhaar5.jpg', 'staffdata/prifilePhotos/photo.jpg', 'DL5678', 'staffdata/licenses/license.jpg', '9876543214', '1234567894'),
                        (11, 'driver', 'Rajesh', 'Patel', '1990-01-01', '2015-01-01', '2050-01-01', '123 Main St', 'Apt 1', 'Ahmedabad', 'Gujarat', '380001', '123456789012', 'staffdata/aadharCardImg/aadhar.jpg', 'staffdata/prifilePhotos/photo.jpg', 'DL123456', 'staffdata/licenses/license.jpg', '9876543210', NULL),
                        (12, 'conductor', 'Amit', 'Shah', '1995-03-15', '2017-06-01', '2052-06-01', '456 Park Ave', 'Suite 2B', 'Surat', 'Gujarat', '395001', '234567890123', 'staffdata/aadharCardImg/aadhar.jpg', 'staffdata/prifilePhotos/photo.jpg', 'DL234567', 'staffdata/licenses/license.jpg', '9876543211', NULL),
                        (13, 'driver', 'Suresh', 'Nair', '1988-05-22', '2014-03-15', '2049-03-15', '789 Elm St', '', 'Vadodara', 'Gujarat', '390001', '345678901234', 'staffdata/aadharCardImg/aadhar.jpg', 'staffdata/prifilePhotos/photo.jpg', 'DL345678', 'staffdata/licenses/license.jpg', '9876543212', '9876543213'),
                        (14, 'conductor', 'Priya', 'Rao', '1993-08-10', '2016-07-01', '2051-07-01', '567 1st St', '', 'Rajkot', 'Gujarat', '360001', '456789012345', 'staffdata/aadharCardImg/aadhar.jpg', 'staffdata/prifilePhotos/photo.jpg', 'DL456789', 'staffdata/licenses/license.jpg', '9876543214', '9876543215'),
                        (15, 'driver', 'Manoj', 'Sharma', '1985-11-12', '2013-05-01', '2048-05-01', '234 5th Ave', 'Floor 4', 'Bhavnagar', 'Gujarat', '364001', '567890123456', 'staffdata/aadharCardImg/aadhar.jpg', 'staffdata/prifilePhotos/photo.jpg', 'DL567890', 'staffdata/licenses/license.jpg', '9876543216', NULL),
                        (16, 'conductor', 'Aarav', 'Patel', '1990-01-01', '2010-01-01', '2050-01-01', '123 Main St', '', 'Ahmedabad', 'Gujarat', '380001', '123456789012', 'staffdata/aadharCardImg/aadhaar.jpg', 'staffdata/prifilePhotos/photo.jpg', 'DL123456', 'staffdata/licenses/license.jpg', '9876543210', ''),
                        (17, 'driver', 'Aryan', 'Shah', '1992-05-22', '2012-01-01', '2057-01-01', '456 Park Ave', '', 'Surat', 'Gujarat', '395001', '234567890123', 'staffdata/aadharCardImg/aadhaar.jpg', 'staffdata/prifilePhotos/photo.jpg', 'DL234567', 'staffdata/licenses/license.jpg', '8765432109', ''),
                        (18, 'conductor', 'Aniket', 'Mehta', '1995-07-15', '2015-01-01', '2060-01-01', '789 Elm St', '', 'Vadodara', 'Gujarat', '390001', '345678901234', 'staffdata/aadharCardImg/aadhaar.jpg', 'staffdata/prifilePhotos/photo.jpg', 'DL345678', 'staffdata/licenses/license.jpg', '7654321098', ''),
                        (19, 'driver', 'Arjun', 'Desai', '1998-03-11', '2018-01-01', '2063-01-01', '321 Oak St', '', 'Rajkot', 'Gujarat', '360001', '456789012345', 'staffdata/aadharCardImg/aadhaar.jpg', 'staffdata/prifilePhotos/photo.jpg', 'DL456789', 'staffdata/licenses/license.jpg', '6543210987', ''),
                        (20, 'conductor', 'Rohan', 'Gupta', '1991-11-30', '2009-01-01', '2049-01-01', '654 Pine St', '', 'Jamnagar', 'Gujarat', '361001', '567890123456', 'staffdata/aadharCardImg/aadhaar.jpg', 'staffdata/prifilePhotos/photo.jpg', 'DL567890', 'staffdata/licenses/license.jpg', '5432109876', '');",
                        );
        foreach ($querys as $query) {
            $conn->exec($query);
        }
        echo "DATA Added successfully"."</br>";
    } 
    catch(PDOException $e) {
        echo $query . "<br>" . $e->getMessage()."</br>";
    }
?>