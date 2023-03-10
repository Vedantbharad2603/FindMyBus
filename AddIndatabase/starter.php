<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "temp_findmybus";
$schema="temp_findmybus";
try {
    $conn = new PDO("mysql:host=$servername;", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully" . "</br>";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage() . "</br>";
}
try {
    $querys = array("CREATE DATABASE IF NOT EXISTS $schema",
                "USE $schema",
                "DROP TABLE IF EXISTS
                    routestops,
                    busschedule,
                    admin,
                    buses,
                    staff,
                    depo",
                "CREATE TABLE IF NOT EXISTS admin (
                        Id VARCHAR(15) NOT NULL PRIMARY KEY,
                        FirstName VARCHAR(15) NOT NULL,
                        LastName VARCHAR(15) NOT NULL,
                        Roll VARCHAR(15) NOT NULL,
                        Password VARCHAR(30) NOT NULL
                    );",
                "CREATE TABLE IF NOT EXISTS buses (
                        Id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                        BusNumber VARCHAR(50) NOT NULL,
                        Type VARCHAR(50) NOT NULL,
                        TotalSeats INT NOT NULL,
                        EngineNo VARCHAR(100) NOT NULL,
                        InsuranceNo VARCHAR(100) NOT NULL
                    );",
                "CREATE TABLE IF NOT EXISTS staff (
                        Id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                        Type VARCHAR(20) NOT NULL,
                        FirstName VARCHAR(20) NOT NULL,
                        MiddleName VARCHAR(20) NOT NULL,
                        LastName VARCHAR(20) NOT NULL,
                        DOB DATE NOT NULL,
                        JoiningDate DATE NOT NULL,
                        RetirementDate DATE NOT NULL,
                        Address1 VARCHAR(255) NOT NULL,
                        Address2 VARCHAR(255) NOT NULL,
                        City VARCHAR(255) NOT NULL,
                        State VARCHAR(255) NOT NULL,
                        PinCode VARCHAR(10) NOT NULL,
                        AddarCardNo VARCHAR(12) NOT NULL,
                        AddarCardURL VARCHAR(255) NOT NULL,
                        ProfilePhotoURL VARCHAR(255) NOT NULL,
                        LicenceNo VARCHAR(50) NOT NULL,
                        LicenceURL VARCHAR(255) NOT NULL,
                        WorkMobileNo VARCHAR(10) NOT NULL,
                        HomeMobileNo VARCHAR(10) DEFAULT NULL
                    );",
                "CREATE TABLE IF NOT EXISTS depo (
                        Id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                        Name VARCHAR(50) NOT NULL,
                        NoOfPlatforms INT NOT NULL,
                        Address1 VARCHAR(255) NOT NULL,
                        Address2 VARCHAR(255) NOT NULL,
                        City VARCHAR(255) NOT NULL,
                        State VARCHAR(255) NOT NULL,
                        PinCode VARCHAR(10) NOT NULL,
                        WorkPhoneNo VARCHAR(11) NOT NULL,
                        SecondPhoneNo VARCHAR(11) DEFAULT NULL
                    );",
                "CREATE TABLE IF NOT EXISTS busschedule (
                        TripId VARCHAR(15) NOT NULL PRIMARY KEY,
                        Name VARCHAR(50) NOT NULL,
                        StartLocation VARCHAR(100) NOT NULL,
                        EndLocation VARCHAR(100) NOT NULL,
                        DriverId INT,
                        ConductorId INT,
                        BusId INT,
                        CONSTRAINT fk_bs_driverid FOREIGN KEY (DriverId) REFERENCES staff(Id),
                        CONSTRAINT fk_bs_conductorid FOREIGN KEY (ConductorId) REFERENCES staff(Id),
                        CONSTRAINT fk_bs_busid FOREIGN KEY (BusId) REFERENCES buses(Id)
                    );",
                "CREATE TABLE IF NOT EXISTS routestops (
                        TripId VARCHAR(15),
                        StopIndex INT NOT NULL,
                        DepoId INT,
                        DepoName varchar(50) NOT NULL,
                        ArrivalTime TIME NOT NULL,
                        DepatureTime TIME NOT NULL,
                        CONSTRAINT fk_rs_routeid FOREIGN KEY (TripId) REFERENCES busschedule(TripId),
                        CONSTRAINT fk_rs_depoid FOREIGN KEY (DepoId) REFERENCES depo(Id)
                    );",
    );
    foreach ($querys as $query) {
        $conn->exec($query);
    }
    echo "Database AND table created successfully" . "</br>";
    $querys = array("INSERT INTO `buses` (`BusNumber`, `Type`, `TotalSeats`, `EngineNo`, `InsuranceNo`)
                    VALUES 
                        ('ABC123', 'Sleeper', 40, '123456', 'INS123'),
                        ('DEF456', 'Seater', 30, '789012', 'INS456'),
                        ('GHI789', 'Sleeper', 40, '345678', 'INS789'),
                        ('JKL012', 'Seater', 30, '901234', 'INS012'),
                        ('MNO345', 'Sleeper', 40, '567890', 'INS345'),
                        ('PQR678', 'Seater', 30, '123789', 'INS678'),
                        ('STU901', 'Sleeper', 40, '890123', 'INS901'),
                        ('VWX234', 'Seater', 30, '456789', 'INS234'),
                        ('YZA567', 'Sleeper', 40, '012345', 'INS567'),
                        ('BCD890', 'Seater', 30, '678901', 'INS890'),
                        ('EFG123', 'Sleeper', 40, '234567', 'INS123'),
                        ('HIJ456', 'Seater', 30, '890123', 'INS456'),
                        ('KLM789', 'Sleeper', 40, '456789', 'INS789'),
                        ('NOP012', 'Seater', 30, '012345', 'INS012'),
                        ('QRS345', 'Sleeper', 40, '678901', 'INS345');",
                    "INSERT INTO staff (Type, FirstName, MiddleName, LastName, DOB, JoiningDate, RetirementDate, Address1, Address2, City, State, PinCode, AddarCardNo, AddarCardURL, ProfilePhotoURL, LicenceNo, LicenceURL, WorkMobileNo, HomeMobileNo)
                    VALUES 
                    -- //TODO phonenumber not be same AND no any female drivers 
                        ('driver', 'Amit', 'Kumar', 'Sharma', '1992-05-23', '2020-02-01', '2055-02-01', 'Sarkhej-Gandhinagar Highway', 'Opp. Rajpath Club', 'Ahmedabad', 'Gujarat', '380015', '111111111111', '../staffdata/aadharcard/aadhar.jpg', '../staffdata/profilePhoto/photo.jpg', 'GJ-01 2015010123456', '../staffdata/Licence/licencePhoto.jpg', '9876543210', NULL),
                        ('conductor', 'Sneha', 'R', 'Patel', '1996-11-04', '2021-03-15', '2056-03-15', 'Near RTO Office', 'Fatehpura', 'Vadodara', 'Gujarat', '390006', '222222222222', '../staffdata/aadharcard/aadhar.jpg', '../staffdata/profilePhoto/photo.jpg', 'GJ-06 2017010123456', '../staffdata/Licence/licencePhoto.jpg', '9876543211', '9825678643'),
                        ('driver', 'Vijay', 'K', 'Mehta', '1988-08-12', '2019-12-01', '2054-12-01', 'Karanj', 'Opp. Bharat Petroleum Pump', 'Bharuch', 'Gujarat', '392001', '333333333333', '../staffdata/aadharcard/aadhar.jpg', '../staffdata/profilePhoto/photo.jpg', 'GJ-16 2014010123456', '../staffdata/Licence/licencePhoto.jpg', '9876543212', NULL),
                        ('conductor', 'Nilesh', 'V', 'Shah', '1994-03-10', '2020-05-01', '2055-05-01', 'Rajkot-Jamnagar Highway', 'Opp. Morbi Road', 'Rajkot', 'Gujarat', '360005', '444444444444', '../staffdata/aadharcard/aadhar.jpg', '../staffdata/profilePhoto/photo.jpg', 'GJ-03 2016010123456', '../staffdata/Licence/licencePhoto.jpg', '9876543213', NULL),
                        ('driver', 'Nitin', 'Kumar', 'Patel', '1985-09-17', '2010-01-01', '2055-09-17', 'Dabhoi Road', 'Shivaji Chowk', 'Vadodara', 'Gujarat', '390019', '555555555555', '../staffdata/aadharcard/aadhar.jpg', '../staffdata/profilePhoto/photo.jpg', 'DL-2010-00001', '../staffdata/Licence/licencePhoto.jpg', '9876543210',NULL),
                        ('conductor', 'Kiran', 'M', 'Patel', '1985-05-23', '2010-07-01', '2055-07-01', '45, Shivam Society', 'Near Bhaktinagar Circle', 'Rajkot', 'Gujarat', '360002', '666666666666', '../staffdata/aadharcard/aadhar.jpg', '../staffdata/profilePhoto/photo.jpg', 'GJ-03 123456', '../staffdata/Licence/licencePhoto.jpg', '9876543210', '9876543210'),
                        ('driver', 'Hiral', 'N', 'Shah', '1990-02-11', '2013-04-01', '2058-04-01', '101, Ambika Park', 'Near Mahavir Hall', 'Surat', 'Gujarat', '395006', '777777777777', '../staffdata/aadharcard/aadhar.jpg', '../staffdata/profilePhoto/photo.jpg', 'GJ-05 789012', '../staffdata/Licence/licencePhoto.jpg', '9876543211', NULL),
                        ('conductor', 'Vishal', 'B', 'Desai', '1988-08-10', '2012-01-01', '2047-01-01', '302, Triveni Flats', 'Near Sardar Patel Ring Road', 'Ahmedabad', 'Gujarat', '380015', '888888888888', '../staffdata/aadharcard/aadhar.jpg', '../staffdata/profilePhoto/photo.jpg', 'GJ-01 456789', '../staffdata/licence/licencephoto.jpg', '9876543212', '9876543212'),
                        ('driver', 'Neha', 'K', 'Thakkar', '1995-04-03', '2018-05-01', '2063-05-01', '16, Jeevandeep Society', 'Near Bhulka Bhavan School', 'Vadodara', 'Gujarat', '390007', '999999999999', '../staffdata/aadharcard/aadhar.jpg', '../staffdata/profilePhoto/photo.jpg', 'GJ-06 234567', '../staffdata/licence/licencephoto.jpg', '9876543213', '9876543213'),
                        ('conductor', 'Rajesh', 'D', 'Chaudhary', '1986-11-20', '2011-09-01', '2056-09-01', '39, Siddhraj Nagar', 'Near RTO Circle', 'Gandhinagar', 'Gujarat', '382007', '123456789012', '../staffdata/aadharcard/aadhar.jpg', '../staffdata/profilePhoto/photo.jpg', 'GJ-18 345678', '../staffdata/licence/licencephoto.jpg', '9876543214', '9876543214'),
                        ('driver', 'Rahul', 'Kumar', 'Sharma', '1995-05-10', '2020-02-01', '2045-05-10', '145, Vasant Vihar Society', 'Nana Varachha', 'Surat', 'Gujarat', '395006', '987654321012', '../staffdata/aadharcard/aadhar.jpg', '../staffdata/profilephoto/photo.jpg', 'GJ01234567', '../staffdata/licence/licencephoto.jpg', '9876543210', NULL),
                        ('conductor', 'Amit', 'Rajesh', 'Patel', '1992-01-25', '2015-06-01', '2042-01-25', '3, Sardar Park Society', 'Adajan', 'Surat', 'Gujarat', '395009', '123456789012', '../staffdata/aadharcard/aadhar.jpg', '../staffdata/profilephoto/photo.jpg', 'GJ12345678', '../staffdata/licence/licencephoto.jpg', '9876543210', NULL),
                        ('driver', 'Neha', 'Vijay', 'Gupta', '1990-12-15', '2018-01-01', '2043-12-15', '11, Shivdarshan Society', 'Katargam', 'Surat', 'Gujarat', '395004', '456789012345', '../staffdata/aadharcard/aadhar.jpg', '../staffdata/profilephoto/photo.jpg', 'GJ23456789', '../staffdata/licence/licencephoto.jpg', '9876543210', NULL),
                        ('conductor', 'Sneha', 'Amit', 'Mehta', '1998-07-22', '2021-01-01', '2046-07-22', '202, Rajhans Society', 'Adajan', 'Surat', 'Gujarat', '395009', '789012345678', '../staffdata/aadharcard/aadhar.jpg', '../staffdata/profilephoto/photo.jpg', 'GJ34567890', '../staffdata/licence/licencephoto.jpg', '9876543210', NULL),
                        ('driver', 'Rajesh', 'Nilesh', 'Shah', '1993-03-05', '2017-06-01', '2043-03-05', '401, Sarthi Apartment', 'Katargam', 'Surat', 'Gujarat', '395004', '901234567890', '../staffdata/aadharcard/aadhar.jpg', '../staffdata/profilephoto/photo.jpg', 'GJ45678901', '../staffdata/licence/licencephoto.jpg', '9876543210', NULL),
                        ('conductor', 'Rajesh', 'Kumar', 'Patel', '1985-05-10', '2015-04-01', '2045-04-01', '123 Main Street', 'Gujarat', 'Ahmedabad', 'Gujarat', '380001', '123456789012', '../staffdata/aadharcard/aadhar.jpg', '../staffdata/profilephoto/photo.jpg', 'ABCD123456', '../staffdata/licence/licencephoto.jpg', '9876543210', NULL),
                        ('driver', 'Anjali', 'Dev', 'Shah', '1990-07-15', '2017-03-12', '2047-03-12', '456 2nd Street', 'Gujarat', 'Surat', 'Gujarat', '395007', '123456789012', '../staffdata/aadharcard/aadhar.jpg', '../staffdata/profilephoto/photo.jpg', 'EFGH456789', '../staffdata/licence/licencephoto.jpg', '9876543211', NULL),
                        ('conductor', 'Amit', 'Kumar', 'Jain', '1988-03-21', '2018-06-01', '2048-06-01', '789 3rd Street', 'Gujarat', 'Rajkot', 'Gujarat', '360005', '123456789012', '../staffdata/aadharcard/aadhar.jpg', '../staffdata/profilephoto/photo.jpg', 'IJKL123456', '../staffdata/licence/licencephoto.jpg', '9876543212', NULL),
                        ('driver', 'Mukesh', 'Singh', 'Parmar', '1992-12-28', '2016-02-15', '2046-02-15', '101 4th Street', 'Gujarat', 'Vadodara', 'Gujarat', '390001', '123456789012', '../staffdata/aadharcard/aadhar.jpg', '../staffdata/profilephoto/photo.jpg', 'MNOP456789', '../staffdata/licence/licencephoto.jpg', '9876543213', NULL),
                        ('conductor', 'Suresh', 'Babu', 'Desai', '1984-11-01', '2014-07-01', '2044-07-01', '234 5th Street', 'Gujarat', 'Surat', 'Gujarat', '395009', '123456789012', '../staffdata/aadharcard/aadhar.jpg', '../staffdata/profilephoto/photo.jpg', 'QRST123456', '../staffdata/licence/licencephoto.jpg', '9876543214', NULL),
                        ('driver', 'Rajesh', 'Kumar', 'Patel', '1990-01-01', '2020-01-01', '2050-01-01', '456 Street Road', 'Gujarat', 'Surat', 'Gujarat', '395001', '123456789012', '../staffdata/aadharcard/aadhar.jpg', '../staffdata/profilephoto/photo.jpg', 'ABCD123456', '../staffdata/licence/licencephoto.jpg', '9876543210', NULL),
                        ('conductor', 'Priya', 'Singh', 'Shah', '1995-02-01', '2021-01-01', '2051-01-01', '789 Lane Avenue', 'Gujarat', 'Vadodara', 'Gujarat', '390001', '234567890123', '../staffdata/aadharcard/aadhar.jpg', '../staffdata/profilephoto/photo.jpg', 'EFGH123456', '../staffdata/licence/licencephoto.jpg', '9876543210', NULL),
                        ('driver', 'Suresh', 'Chandra', 'Joshi', '1992-03-01', '2019-01-01', '2049-01-01', '1111 Main Street', 'Gujarat', 'Rajkot', 'Gujarat', '360001', '345678901234', '../staffdata/aadharcard/aadhar.jpg', '../staffdata/profilephoto/photo.jpg', 'IJKL123456', '../staffdata/licence/licencephoto.jpg', '9876543210', NULL),
                        ('conductor', 'Deepak', 'Mohan', 'Desai', '1988-04-01', '2022-01-01', '2052-01-01', '2222 First Street', 'Gujarat', 'Jamnagar', 'Gujarat', '361001', '456789012345', '../staffdata/aadharcard/aadhar.jpg', '../staffdata/profilephoto/photo.jpg', 'MNOP123456', '../staffdata/licence/licencephoto.jpg', '9876543210', NULL),
                        ('driver', 'Amit', 'Kumar', 'Sharma', '1991-05-01', '2020-01-01', '2050-01-01', '3333 Second Street', 'Gujarat', 'Ahmedabad', 'Gujarat', '380001', '567890123456', '../staffdata/aadharcard/aadhar.jpg', '../staffdata/profilephoto/photo.jpg', 'QRST123456', '../staffdata/licence/licencephoto.jpg', '9876543210', NULL),
                        ('conductor', 'Anjali', 'Rajesh', 'Shah', '1990-01-01', '2020-01-01', '2050-01-01', '1st Floor, Abhinav Tower', 'Nr. Shivam Hospital', 'Surat', 'Gujarat', '395009', '123456789012', '../staffdata/aadharcard/aadhar.jpg', '../staffdata/profilephoto/photo.jpg', 'GJ0123456789', '../staffdata/licence/licencephoto.jpg', '9876543210', NULL),
                        ('driver','Akash', 'Kumar', 'Patel', '1995-03-15', '2018-01-01', '2048-01-01', 'B-102, Shruti Villa', 'Behind Krishna Park', 'Ahmedabad', 'Gujarat', '380051', '234567890123', '../staffdata/aadharcard/aadhar.jpg', '../staffdata/profilephoto/photo.jpg', 'GJ0123456789', '../staffdata/licence/licencephoto.jpg', '9876543211', NULL),
                        ('conductor', 'Rahul', 'Bharat', 'Desai', '1985-05-12', '2015-01-01', '2045-01-01', 'Block No. 17, Gulab Society', 'Near D Mart', 'Vadodara', 'Gujarat', '390007', '345678901234', '../staffdata/aadharcard/aadhar.jpg', '../staffdata/profilephoto/photo.jpg', 'GJ0123456789', '../staffdata/licence/licencephoto.jpg', '9876543212', NULL),
                        ('driver', 'Deepika', 'Nilesh', 'Mehta', '1992-11-23', '2019-01-01', '2049-01-01', 'A-203, Anand Tower', 'Near Bhagwati Nagar', 'Rajkot', 'Gujarat', '360002', '456789012345', '../staffdata/aadharcard/aadhar.jpg', '../staffdata/profilephoto/photo.jpg', 'GJ0123456789', '../staffdata/licence/licencephoto.jpg', '9876543213', NULL),
                        ('conductor', 'Neha', 'Amit', 'Joshi', '1991-07-19', '2017-01-01', '2047-01-01', 'C-4, Rajdeep Society', 'Near Vishalnagar', 'Bhavnagar', 'Gujarat', '364001', '567890123456', '../staffdata/aadharcard/aadhar.jpg', '../staffdata/profilephoto/photo.jpg', 'GJ0123456789', '../staffdata/licence/licencephoto.jpg', '9876543214', NULL),
                        ;",
                    "INSERT INTO depo (Name, NoOfPlatforms, Address1, Address2, City, State, PinCode, WorkPhoneNo, SecondPhoneNo)
                    VALUES 
                        ('Ahmedabad Bus Depot', 10, 'Gheekanta Road', 'Near Kalupur Railway Station', 'Ahmedabad', 'Gujarat', '380002', '079-25461234', '079-25462345'),
                        ('Surat Bus Depot', 8, 'Ring Road', 'Near Udhna Darwaja', 'Surat', 'Gujarat', '395002', '0261-2546123', '0261-2546234'),
                        ('Vadodara Bus Depot', 12, 'Genda Circle', 'Near Lal Baug', 'Vadodara', 'Gujarat', '390005', '0265-2546123', '0265-2546234'),
                        ('Rajkot Bus Depot', 6, 'Gondal Road', 'Near Madhapar Chowkadi', 'Rajkot', 'Gujarat', '360006', '0281-2546123', NULL),
                        ('Bhavnagar Bus Depot', 4, 'Station Road', 'Near Jubilee Circle', 'Bhavnagar', 'Gujarat', '364001', '0278-2546123', NULL),
                        ('Gandhinagar Bus Depot', 3, 'Infocity Road', 'Near GH-5 Circle', 'Gandhinagar', 'Gujarat', '382009', '079-2546123', '079-2546234'),
                        ('Jamnagar Bus Depot', 5, 'Bedi Road', 'Near Gokul Nagar', 'Jamnagar', 'Gujarat', '361008', '0288-2546123', '0288-2546234'),
                        ('Junagadh Bus Depot', 2, 'Bilkha Road', 'Near Girnar Taleti', 'Junagadh', 'Gujarat', '362001', '0285-2546123', NULL),
                        ('Mehsana Bus Depot', 7, 'Modhera Road', 'Near Ganpat University', 'Mehsana', 'Gujarat', '384002', '02762-254612', '02762-254623'),
                        ('Bharuch Bus Depot', 4, 'NH-8', 'Near GNFC Township', 'Bharuch', 'Gujarat', '392015', '02642-254612', NULL);",
                    "INSERT INTO busschedule (TripId, Name, StartLocation, EndLocation, DriverId, ConductorId, BusId) 
                    VALUES 
                        ('TRP001', 'Ahmedabad and Surat', 'Ahmedabad', 'Surat', 1, 2, 1),
                        ('TRP002', 'Vadodara and Rajkot', 'Vadodara', 'Rajkot', 3, 4, 2),
                        ('TRP003', 'Bhavnagar and Gandhinagar', 'Bhavnagar', 'Gandhinagar', 5, 6, 3),
                        ('TRP004', 'Jamnagar and Junagadh', 'Jamnagar', 'Junagadh', 7, 8, 4),
                        ('TRP005', 'Mehsana and Bharuch', 'Mehsana', 'Bharuch', 9, 10, 5),
                        ('TRP006', 'Surat and Rajkot', 'Surat', 'Rajkot', 11, 12, 6),
                        ('TRP007', 'Ahmedabad and Vadodara', 'Ahmedabad', 'Vadodara', 13, 14, 7),
                        ('TRP008', 'Bhavnagar and Mehsana', 'Bhavnagar', 'Mehsana', 15, 16, 8),
                        ('TRP009', 'Jamnagar and Gandhinagar', 'Jamnagar', 'Gandhinagar', 17, 18, 9),
                        ('TRP010', 'Junagadh and Bharuch', 'Junagadh', 'Bharuch', 19, 20, 10),
                        ('TRP011', 'Ahmedabad and Rajkot', 'Ahmedabad', 'Rajkot', 21, 22, 11),
                        ('TRP012', 'Surat and Vadodara', 'Surat', 'Vadodara', 23, 24, 12),
                        ('TRP013', 'Bhavnagar and Jamnagar', 'Bhavnagar', 'Jamnagar', 25, 26, 13),
                        ('TRP014', 'Gandhinagar and Bharuch', 'Gandhinagar', 'Bharuch', 27, 28, 14),
                        ('TRP015', 'Mehsana and Junagadh', 'Mehsana', 'Junagadh', 29, 30, 15),
                        ('TRP016', 'Vadodara and Jamnagar', 'Vadodara', 'Jamnagar', 31, 32, 16),
                        ('TRP017', 'Surat and Bhavnagar', 'Surat', 'Bhavnagar', 33, 34, 17),
                        ('TRP018', 'Ahmedabad and Bharuch', 'Ahmedabad', 'Bharuch', 35, 36, 18),
                        ('TRP019', 'Rajkot and Gandhinagar', 'Rajkot', 'Gandhinagar', 37, 38, 19),
                        ('TRP020', 'Vadodara and Bhavnagar', 'Vadodara', 'Bhavnagar', 39, 40, 20),
                        -- return
                        ('TRP101', 'Surat and Ahmedabad', 'Surat', 'Ahmedabad', 1, 2, 1),
                        ('TRP102', 'Rajkot and Vadodara', 'Rajkot', 'Vadodara', 3, 4, 2),
                        ('TRP103', 'Gandhinagar and Bhavnagar', 'Gandhinagar', 'Bhavnagar', 5, 6, 3),
                        ('TRP104', 'Junagadh and Jamnagar', 'Junagadh', 'Jamnagar', 7, 8, 4),
                        ('TRP105', 'Bharuch and Mehsana', 'Bharuch', 'Mehsana', 9, 10, 5),
                        ('TRP106', 'Rajkot and Surat', 'Rajkot', 'Surat', 11, 12, 6),
                        ('TRP107', 'Vadodara and Ahmedabad', 'Vadodara', 'Ahmedabad', 13, 14, 7),
                        ('TRP108', 'Mehsana and Bhavnagar', 'Mehsana', 'Bhavnagar', 15, 16, 8),
                        ('TRP109', 'Gandhinagar and Jamnagar', 'Gandhinagar', 'Jamnagar', 17, 18, 9),
                        ('TRP110', 'Bharuch and Junagadh', 'Bharuch', 'Junagadh', 19, 20, 10),
                        ('TRP111', 'Rajkot and Ahmedabad', 'Rajkot', 'Ahmedabad', 21, 22, 11),
                        ('TRP112', 'Vadodara and Surat', 'Vadodara', 'Surat', 23, 24, 12),
                        ('TRP113', 'Jamnagar and Bhavnagar', 'Jamnagar', 'Bhavnagar', 25, 26, 13),
                        ('TRP114', 'Bharuch and Gandhinagar', 'Bharuch', 'Gandhinagar', 27, 28, 14),
                        ('TRP115', 'Junagadh and Mehsana', 'Junagadh', 'Mehsana', 29, 30, 15),
                        ('TRP116', 'Jamnagar and Vadodara', 'Jamnagar', 'Vadodara', 31, 32, 16),
                        ('TRP117', 'Bhavnagar and Surat', 'Bhavnagar', 'Surat', 33, 34, 17),
                        ('TRP118', 'Bharuch and Ahmedabad', 'Bharuch', 'Ahmedabad', 35, 36, 18),
                        ('TRP119', 'Gandhinagar and Rajkot', 'Gandhinagar', 'Rajkot', 37, 38, 19),
                        ('TRP120', 'Bhavnagar and Vadodara', 'Bhavnagar', 'Vadodara', 39, 40, 20);");
    foreach ($querys as $query) {
        $conn->exec($query);
    }
    echo "DATA Added successfully" . "</br>";
} catch (PDOException $e) {
    echo $query . "<br>" . $e->getMessage() . "</br>";
}
?>