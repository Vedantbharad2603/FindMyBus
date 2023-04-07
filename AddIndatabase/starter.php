<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "findmybus";
    $schema="findmybus";
    try {
        $pdo = new PDO("mysql:host=$servername;", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
                        fualType VARCHAR(20) NOT NULL,
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
                        City VARCHAR(20) NOT NULL,
                        State VARCHAR(20) NOT NULL,
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
                        SecondPhoneNo VARCHAR(11)
                    );",
                "CREATE TABLE IF NOT EXISTS busschedule (
                        TripId VARCHAR(15) NOT NULL PRIMARY KEY,
                        Name VARCHAR(50) NOT NULL,
                        StartLocation VARCHAR(100) NOT NULL,
                        EndLocation VARCHAR(100) NOT NULL,
                        Distances INT,
                        Price INT,
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
                        ArrivalTime TIME,
                        DepatureTime TIME,
                        latetime TIME,
                        CONSTRAINT fk_rs_routeid FOREIGN KEY (TripId) REFERENCES busschedule(TripId),
                        CONSTRAINT fk_rs_depoid FOREIGN KEY (DepoId) REFERENCES depo(Id)
                    );",
    );
    foreach ($querys as $query) {
        $pdo->exec($query);
    }
    echo "Database TO table created successfully" . "</br>";
    $querys = array("INSERT INTO `buses` (`BusNumber`, `Type`,`fualType`,`TotalSeats`, `EngineNo`, `InsuranceNo`)
                    VALUES 
                        ('ABC123', 'Sleeper','Diesel', 40, '123456', 'INS123'),
                        ('DEF456', 'Seater','Electric', 30, '789012', 'INS456'),
                        ('GHI789', 'Sleeper','Diesel', 40, '345678', 'INS789'),
                        ('JKL012', 'Seater','Electric', 30, '901234', 'INS012'),
                        ('MNO345', 'Sleeper','Diesel', 40, '567890', 'INS345'),
                        ('PQR678', 'Seater','Electric', 30, '123789', 'INS678'),
                        ('STU901', 'Sleeper','Diesel', 40, '890123', 'INS901'),
                        ('VWX234', 'Seater','Diesel', 30, '456789', 'INS234'),
                        ('YZA567', 'Sleeper','Electric', 40, '012345', 'INS567'),
                        ('BCD890', 'Seater','Diesel', 30, '678901', 'INS890'),
                        ('EFG123', 'Sleeper','Electric', 40, '234567', 'INS123'),
                        ('HIJ456', 'Seater','Diesel', 30, '890123', 'INS456'),
                        ('KLM789', 'Sleeper','Electric', 40, '456789', 'INS789'),
                        ('NOP012', 'Seater','Diesel', 30, '012345', 'INS012'),
                        ('QRS345', 'Sleeper','Diesel', 40, '678901', 'INS345');",
                    "INSERT INTO staff (Type, FirstName, MiddleName, LastName, DOB, JoiningDate, RetirementDate, Address1, Address2, City, State, PinCode, AddarCardNo, AddarCardURL, ProfilePhotoURL, LicenceNo, LicenceURL, WorkMobileNo, HomeMobileNo)
                    VALUES
                        ('driver', 'Amit', 'Kumar', 'Sharma', '1992-05-23', '2020-02-01', '2055-02-01', 'Sarkhej-Gandhinagar Highway', 'Opp. Rajpath Club', 'Ahmedabad', 'Gujarat', '380015', '111111111111', '../staffdata/aadharcard/aadhar.jpg', '../staffdata/profilePhoto/photo.jpg', 'GJ012015010123456', '../staffdata/Licence/licencePhoto.jpg', '9976543210', NULL),
                        ('conductor', 'Sneha', 'R', 'Patel', '1996-11-04', '2021-03-15', '2056-03-15', 'Near RTO Office', 'Fatehpura', 'Vadodara', 'Gujarat', '390006', '222222222222', '../staffdata/aadharcard/aadhar.jpg', '../staffdata/profilePhoto/photo.jpg', 'GJ062017010123456', '../staffdata/Licence/licencePhoto.jpg', '9876543212', '9825678643'),
                        ('driver', 'Vijay', 'K', 'Mehta', '1988-08-12', '2019-12-01', '2054-12-01', 'Karanj', 'Opp. Bharat Petroleum Pump', 'Bharuch', 'Gujarat', '392001', '333333333333', '../staffdata/aadharcard/aadhar.jpg', '../staffdata/profilePhoto/photo.jpg', 'GJ162014010123456', '../staffdata/Licence/licencePhoto.jpg', '9876543222', NULL),
                        ('conductor', 'Nilesh', 'V', 'Shah', '1994-03-10', '2020-05-01', '2055-05-01', 'Rajkot-Jamnagar Highway', 'Opp. Morbi Road', 'Rajkot', 'Gujarat', '360005', '444444444444', '../staffdata/aadharcard/aadhar.jpg', '../staffdata/profilePhoto/photo.jpg', 'GJ032016010123456', '../staffdata/Licence/licencePhoto.jpg', '9876543233', NULL),
                        ('driver', 'Nitin', 'Kumar', 'Patel', '1985-09-17', '2010-01-01', '2055-09-17', 'Dabhoi Road', 'Shivaji Chowk', 'Vadodara', 'Gujarat', '390019', '555555555555', '../staffdata/aadharcard/aadhar.jpg', '../staffdata/profilePhoto/photo.jpg', 'DL201000456585001', '../staffdata/Licence/licencePhoto.jpg', '9886543210',NULL),
                        ('conductor', 'Kiran', 'M', 'Patel', '1985-05-23', '2010-07-01', '2055-07-01', '45, Shivam Society', 'Near Bhaktinagar Circle', 'Rajkot', 'Gujarat', '360002', '666666666666', '../staffdata/aadharcard/aadhar.jpg', '../staffdata/profilePhoto/photo.jpg', 'GJ037845123456745', '../staffdata/Licence/licencePhoto.jpg', '9876543211', '9872543210'),
                        ('driver', 'Vishal', 'N', 'Shah', '1990-02-11', '2013-04-01', '2058-04-01', '101, Ambika Park', 'Near Mahavir Hall', 'Surat', 'Gujarat', '395006', '777777777777', '../staffdata/aadharcard/aadhar.jpg', '../staffdata/profilePhoto/photo.jpg', 'GJ057887542190172', '../staffdata/Licence/licencePhoto.jpg', '9876542211', NULL),
                        ('conductor', 'Hiral', 'B', 'Desai', '1988-08-10', '2012-01-01', '2047-01-01', '302, Triveni Flats', 'Near Sardar Patel Ring Road', 'Ahmedabad', 'Gujarat', '380015', '888888888888', '../staffdata/aadharcard/aadhar.jpg', '../staffdata/profilePhoto/photo.jpg', 'GJ014574856789741', '../staffdata/licence/licencephoto.jpg', '9876543214', '9879543215'),
                        ('driver', 'Rajesh', 'K', 'Thakkar', '1995-04-03', '2018-05-01', '2063-05-01', '16, Jeevandeep Society', 'Near Bhulka Bhavan School', 'Vadodara', 'Gujarat', '390007', '999999999999', '../staffdata/aadharcard/aadhar.jpg', '../staffdata/profilePhoto/photo.jpg', 'GJ062374521545677', '../staffdata/licence/licencephoto.jpg', '9876543213', '9876543244'),
                        ('conductor', 'Neha', 'D', 'Chaudhary', '1986-11-20', '2011-09-01', '2056-09-01', '39, Siddhraj Nagar', 'Near RTO Circle', 'Gandhinagar', 'Gujarat', '382007', '123456789012', '../staffdata/aadharcard/aadhar.jpg', '../staffdata/profilePhoto/photo.jpg', 'GJ183456774587854', '../staffdata/licence/licencephoto.jpg', '9876543288', '9876544214'),
                        ('driver', 'Rahul', 'Kumar', 'Sharma', '1995-05-10', '2020-02-01', '2045-05-10', '145, Vasant Vihar Society', 'Nana Varachha', 'Surat', 'Gujarat', '395006', '987654321012', '../staffdata/aadharcard/aadhar.jpg', '../staffdata/profilephoto/photo.jpg', 'GJ012345644754417', '../staffdata/licence/licencephoto.jpg', '9876543216', NULL),
                        ('conductor', 'Neha', 'Rajesh', 'Patel', '1992-01-25', '2015-06-01', '2042-01-25', '3, Sardar Park Society', 'Adajan', 'Surat', 'Gujarat', '395009', '123886789012', '../staffdata/aadharcard/aadhar.jpg', '../staffdata/profilephoto/photo.jpg', 'GJ123475412865678', '../staffdata/licence/licencephoto.jpg', '9876113210', NULL),
                        ('driver', 'Amit', 'Vijay', 'Gupta', '1990-12-15', '2018-01-01', '2043-12-15', '11, Shivdarshan Society', 'Katargam', 'Surat', 'Gujarat', '395004', '456789015445', '../staffdata/aadharcard/aadhar.jpg', '../staffdata/profilephoto/photo.jpg', 'GJ234567897755485', '../staffdata/licence/licencephoto.jpg', '9876543299', NULL),
                        ('conductor', 'Sneha', 'Amit', 'Mehta', '1998-07-22', '2021-01-01', '2046-07-22', '202, Rajhans Society', 'Adajan', 'Surat', 'Gujarat', '395009', '789012345678', '../staffdata/aadharcard/aadhar.jpg', '../staffdata/profilephoto/photo.jpg', 'GJ345678975477620', '../staffdata/licence/licencephoto.jpg', '9876333210', NULL),
                        ('driver', 'Rajesh', 'Nilesh', 'Shah', '1993-03-05', '2017-06-01', '2043-03-05', '401, Sarthi Apartment', 'Katargam', 'Surat', 'Gujarat', '395004', '901234567890', '../staffdata/aadharcard/aadhar.jpg', '../staffdata/profilephoto/photo.jpg', 'GJ456789018562441', '../staffdata/licence/licencephoto.jpg', '9976543211', NULL),
                        ('conductor', 'Anjali', 'Kumar', 'Patel', '1985-05-10', '2015-04-01', '2045-04-01', '123 Main Street', 'Gujarat', 'Ahmedabad', 'Gujarat', '380001', '123444789012', '../staffdata/aadharcard/aadhar.jpg', '../staffdata/profilephoto/photo.jpg', 'GJ011444273456241', '../staffdata/licence/licencephoto.jpg', '9876543218', NULL),
                        ('driver', 'Rajesh', 'Dev', 'Shah', '1990-07-15', '2017-03-12', '2047-03-12', '456 2nd Street', 'Gujarat', 'Surat', 'Gujarat', '395007', '123495789012', '../staffdata/aadharcard/aadhar.jpg', '../staffdata/profilephoto/photo.jpg', 'GJ124545854674519', '../staffdata/licence/licencephoto.jpg', '9876544211', NULL),
                        ('conductor', 'Amit', 'Kumar', 'Jain', '1988-03-21', '2018-06-01', '2048-06-01', '789 3rd Street', 'Gujarat', 'Rajkot', 'Gujarat', '360005', '123956289012', '../staffdata/aadharcard/aadhar.jpg', '../staffdata/profilephoto/photo.jpg', 'GJ031255485345566', '../staffdata/licence/licencephoto.jpg', '9876543219', NULL),
                        ('driver', 'Mukesh', 'Singh', 'Parmar', '1992-12-28', '2016-02-15', '2046-02-15', '101 4th Street', 'Gujarat', 'Vadodara', 'Gujarat', '390001', '128765789012', '../staffdata/aadharcard/aadhar.jpg', '../staffdata/profilephoto/photo.jpg', 'GJ054564445578957', '../staffdata/licence/licencephoto.jpg', '9876773213', NULL),
                        ('conductor', 'Suresh', 'Babu', 'Desai', '1984-11-01', '2014-07-01', '2044-07-01', '234 5th Street', 'Gujarat', 'Surat', 'Gujarat', '395009', '124556745012', '../staffdata/aadharcard/aadhar.jpg', '../staffdata/profilephoto/photo.jpg', 'GJ085441234567455', '../staffdata/licence/licencephoto.jpg', '9885543214', NULL),
                        ('driver', 'Rajesh', 'Kumar', 'Patel', '1990-01-01', '2020-01-01', '2050-01-01', '456 Street Road', 'Gujarat', 'Surat', 'Gujarat', '395001', '123456799012', '../staffdata/aadharcard/aadhar.jpg', '../staffdata/profilephoto/photo.jpg', 'GJ011245453456254', '../staffdata/licence/licencephoto.jpg', '9871143210', NULL),
                        ('conductor', 'Priya', 'Singh', 'Shah', '1995-02-01', '2021-01-01', '2051-01-01', '789 Lane Avenue', 'Gujarat', 'Vadodara', 'Gujarat', '390001', '234567890123', '../staffdata/aadharcard/aadhar.jpg', '../staffdata/profilephoto/photo.jpg', 'GJ248412345636364', '../staffdata/licence/licencephoto.jpg', '9886583210', NULL),
                        ('driver', 'Suresh', 'Chandra', 'Joshi', '1992-03-01', '2019-01-01', '2049-01-01', '1111 Main Street', 'Gujarat', 'Rajkot', 'Gujarat', '360001', '345678908524', '../staffdata/aadharcard/aadhar.jpg', '../staffdata/profilephoto/photo.jpg', 'GJ031459523123456', '../staffdata/licence/licencephoto.jpg', '9876547865', NULL),
                        ('conductor', 'Deepak', 'Mohan', 'Desai', '1988-04-01', '2022-01-01', '2052-01-01', '2222 First Street', 'Gujarat', 'Jamnagar', 'Gujarat', '361001', '456858512345', '../staffdata/aadharcard/aadhar.jpg', '../staffdata/profilephoto/photo.jpg', 'GJ031241231121456', '../staffdata/licence/licencephoto.jpg', '9877463450', NULL),
                        ('driver', 'Amit', 'V', 'Joshi', '1991-05-01', '2020-01-01', '2050-01-01', '3333 Second Street', 'Gujarat', 'Ahmedabad', 'Gujarat', '380001', '567890154456', '../staffdata/aadharcard/aadhar.jpg', '../staffdata/profilephoto/photo.jpg', 'GJ031241231234546', '../staffdata/licence/licencephoto.jpg', '9876545210', NULL),
                        ('conductor', 'Anjali', 'Rajesh', 'Shah', '1990-01-01', '2020-01-01', '2050-01-01', '1st Floor, Abhinav Tower', 'Nr. Shivam Hospital', 'Surat', 'Gujarat', '395009', '123456788712', '../staffdata/aadharcard/aadhar.jpg', '../staffdata/profilephoto/photo.jpg', 'GJ012345446712721', '../staffdata/licence/licencephoto.jpg', '9876588210', NULL),
                        ('driver','Akash', 'Kumar', 'Patel', '1995-03-15', '2018-01-01', '2048-01-01', 'B-102, Shruti Villa', 'Behind Krishna Park', 'Ahmedabad', 'Gujarat', '380051', '234567899623', '../staffdata/aadharcard/aadhar.jpg', '../staffdata/profilephoto/photo.jpg', 'GJ012341236456789', '../staffdata/licence/licencephoto.jpg', '9874143211', NULL),
                        ('conductor', 'Deepika', 'Bharat', 'Desai', '1985-05-12', '2015-01-01', '2045-01-01', 'Block No. 17, Gulab Society', 'Near D Mart', 'Vadodara', 'Gujarat', '390007', '345678901234', '../staffdata/aadharcard/aadhar.jpg', '../staffdata/profilephoto/photo.jpg', 'GJ014789623456789', '../staffdata/licence/licencephoto.jpg', '9876951212', NULL),
                        ('driver', 'Rahul', 'Nilesh', 'Mehta', '1992-11-23', '2019-01-01', '2049-01-01', 'A-203, Anand Tower', 'Near Bhagwati Nagar', 'Rajkot', 'Gujarat', '360002', '456789012345', '../staffdata/aadharcard/aadhar.jpg', '../staffdata/profilephoto/photo.jpg', 'GJ012348963256789', '../staffdata/licence/licencephoto.jpg', '9876745613', NULL),
                        ('conductor', 'Neha', 'Amit', 'Joshi', '1991-07-19', '2017-01-01', '2047-01-01', 'C-4, Rajdeep Society', 'Near Vishalnagar', 'Bhavnagar', 'Gujarat', '364001', '567890123456', '../staffdata/aadharcard/aadhar.jpg', '../staffdata/profilephoto/photo.jpg', 'GJ012348741256789', '../staffdata/licence/licencephoto.jpg', '9876547845', NULL),
                        ('driver', 'Rahul', 'Narendrabhai', 'Patel', '1985-05-10', '2010-01-01', '2040-01-01', '123 Ashok Nagar', 'Near Swaminarayan Temple', 'Ahmedabad', 'Gujarat', '380015', '123487789012', '../staffdata/aadharcard/aadhar.jpg', '../staffdata/profilephoto/photo.jpg', 'GJ041755412345696', '../staffdata/licence/licencephoto.jpg', '9876143210', '9999999991'),
                        ('conductor', 'Priya', 'Niteshbhai', 'Shah', '1992-02-25', '2015-06-01', '2050-06-01', '456 Sun City', 'Opposite City Mall', 'Vadodara', 'Gujarat', '390001', '235265890123', '../staffdata/aadharcard/aadhar.jpg', '../staffdata/profilephoto/photo.jpg', 'GJ031624123234567', '../staffdata/licence/licencephoto.jpg', '9876243211', NULL),
                        ('driver', 'Rajesh', 'Ghanshyambhai', 'Desai', '1987-07-20', '2012-03-01', '2047-03-01', '789 Gandhi Nagar', 'Near Sardar Patel Stadium', 'Rajkot', 'Gujarat', '360001', '345984501234', '../staffdata/aadharcard/aadhar.jpg', '../staffdata/profilephoto/photo.jpg', 'GJ031241233456748', '../staffdata/licence/licencephoto.jpg', '9876543212', '9999999998'),
                        ('conductor', 'Manisha', 'Mukeshbhai', 'Thakkar', '1990-10-15', '2017-08-01', '2052-08-01', '321 Green Avenue', 'Near Iskcon Temple', 'Surat', 'Gujarat', '395001', '456789784545', '../staffdata/aadharcard/aadhar.jpg', '../staffdata/profilephoto/photo.jpg', 'GJ031241234475789', '../staffdata/licence/licencephoto.jpg', '9887543213', NULL),
                        ('driver', 'Jignesh', 'Kamalbhai', 'Sharma', '1984-03-08', '2009-05-01', '2044-05-01', '567 City Centre', 'Opposite Big Bazaar', 'Jamnagar', 'Gujarat', '361001', '567891203456', '../staffdata/aadharcard/aadhar.jpg', '../staffdata/profilephoto/photo.jpg', 'GJ031241235457890', '../staffdata/licence/licencephoto.jpg', '9878784321', '9999999997'),
                        ('conductor', 'Aarav', 'Patel', 'Shah', '1995-05-10', '2020-01-01', '2050-01-01', '123, New Society', 'Near Railway Station', 'Vadodara', 'Gujarat', '390001', '127756789012', '../staffdata/aadharcard/aadhar.jpg', '../staffdata/profilephoto/photo.jpg', 'GJ031241235457891', '../staffdata/licence/licencephoto.jpg', '9876543245', '9476547845'),
                        ('driver', 'Aarya', 'Gupta', 'Patel', '1992-08-15', '2018-05-05', '2048-05-05', '54, Swagat Bunglows', 'Opposite Bus Stop', 'Surat', 'Gujarat', '395001', '234567898823', '../staffdata/aadharcard/aadhar.jpg', '../staffdata/profilephoto/photo.jpg', 'GJ031241235457892', '../staffdata/licence/licencephoto.jpg', '8776543210', '8276543210'),
                        ('conductor', 'Anaya', 'Desai', 'Mehta', '1998-02-22', '2019-07-15', '2045-07-15', 'B/2, Ravi Society', 'Behind Mall', 'Rajkot', 'Gujarat', '360001', '345677418012', '../staffdata/aadharcard/aadhar.jpg', '../staffdata/profilephoto/photo.jpg', 'GJ031241235457893', '../staffdata/licence/licencephoto.jpg', '8776543212', NULL),
                        ('driver', 'Aryan', 'Shah', 'Patel', '1989-06-30', '2016-04-01', '2046-04-01', '12, Ashirwad Residency', 'Near Hospital', 'Ahmedabad', 'Gujarat', '380001', '456789012745', '../staffdata/aadharcard/aadhar.jpg', '../staffdata/profilephoto/photo.jpg', 'GJ031241235457894', '../staffdata/licence/licencephoto.jpg', '9876548217', NULL),
                        ('conductor', 'Ishaan', 'Gandhi', 'Shah', '1993-11-11', '2017-12-31', '2042-12-31', '15, Vrindavan Flats', 'Beside Temple', 'Vadodara', 'Gujarat', '390001', '599890123456', '../staffdata/aadharcard/aadhar.jpg', '../staffdata/profilephoto/photo.jpg', 'GJ031241235457895', '../staffdata/licence/licencephoto.jpg', '9865543210', NULL);",
                    "INSERT INTO depo (Name, NoOfPlatforms, Address1, Address2, City, State, PinCode, WorkPhoneNo, SecondPhoneNo)
                    VALUES 
                        ('Ahmedabad Bus Depot', 10, 'Gheekanta Road', 'Near Kalupur Railway Station', 'Ahmedabad', 'Gujarat', '380002', '9225461234', '9825462345'),
                        ('Surat Bus Depot', 8, 'Ring Road', 'Near Udhna Darwaja', 'Surat', 'Gujarat', '395002', '9982546123', '9125546234'),
                        ('Vadodara Bus Depot', 12, 'Genda Circle', 'Near Lal Baug', 'Vadodara', 'Gujarat', '390005', '9952546123', '9925546234'),
                        ('Rajkot Bus Depot', 6, 'Gondal Road', 'Near Madhapar Chowkadi', 'Rajkot', 'Gujarat', '360006', '9105461223', NULL),
                        ('Bhavnagar Bus Depot', 4, 'Station Road', 'Near Jubilee Circle', 'Bhavnagar', 'Gujarat', '364001', '9642546123', NULL),
                        ('Gandhinagar Bus Depot', 3, 'Infocity Road', 'Near GH-5 Circle', 'Gandhinagar', 'Gujarat', '382009', '9125546123', '9652546234'),
                        ('Jamnagar Bus Depot', 5, 'Bedi Road', 'Near Gokul Nagar', 'Jamnagar', 'Gujarat', '361008', '9825446123', '8726554234'),
                        ('Junagadh Bus Depot', 2, 'Bilkha Road', 'Near Girnar Taleti', 'Junagadh', 'Gujarat', '362001', '8772546123', NULL),
                        ('Mehsana Bus Depot', 7, 'Modhera Road', 'Near Ganpat University', 'Mehsana', 'Gujarat', '384002', '9822546612', '9322545462'),
                        ('Bharuch Bus Depot', 4, 'NH-8', 'Near GNFC Township', 'Bharuch', 'Gujarat', '392015', '9852546125', NULL),
                        ('Anand Bus Depot', 3, 'Near Sardar Patel Statue, V.V Nagar Road', 'Opp. HDFC Bank','Anand', 'Gujarat', '388001', '9876543216',NULL),
                        ('Nadiad Bus Depot', 2, 'Near Mahagujarat Industrial Estate, Chaklashi Road', 'Opposite Vyas Vadi',' Nadiad', 'Gujarat', '387001', '9176543210',NULL),
                        ('Ankleshwar', 4, 'Plot No. 12/13, GIDC, Near Shilpi Party Plot', 'Old NH 8', 'Ankleshwar', 'Gujarat', '393002', '9876543210',NULL);",
                    "INSERT INTO busschedule (TripId, Name, StartLocation, EndLocation,Distances,Price, DriverId, ConductorId, BusId) 
                    VALUES 
                        ('TRP001', 'Ahmedabad To Surat', 'Ahmedabad', 'Surat',278,417, 1, 2, 1),
                        ('TRP002', 'Vadodara To Rajkot', 'Vadodara', 'Rajkot',285,427, 3, 4, 2),
                        ('TRP003', 'Bhavnagar To Gandhinagar', 'Bhavnagar', 'Gandhinagar',186,279, 5, 6, 3),
                        ('TRP004', 'Jamnagar To Junagadh', 'Jamnagar', 'Junagadh',101,151, 7, 8, 4),
                        ('TRP005', 'Mehsana To Bharuch', 'Mehsana', 'Bharuch',201,301, 9, 10, 5),
                        ('TRP006', 'Surat To Rajkot', 'Surat', 'Rajkot',709,1063, 11, 12, 6),
                        ('TRP007', 'Ahmedabad To Vadodara', 'Ahmedabad', 'Vadodara',111,166, 13, 14, 7),
                        ('TRP008', 'Bhavnagar To Mehsana', 'Bhavnagar', 'Mehsana',331,496, 15, 16, 8),
                        ('TRP009', 'Jamnagar To Gandhinagar', 'Jamnagar', 'Gandhinagar',358,537, 17, 18, 9),
                        ('TRP010', 'Junagadh To Bharuch', 'Junagadh', 'Bharuch',599,898, 19, 20, 10),
                        ('TRP011', 'Ahmedabad To Rajkot', 'Ahmedabad', 'Rajkot',213,319, 21, 22, 11),
                        ('TRP012', 'Surat To Vadodara', 'Surat', 'Vadodara',153,229, 23, 24, 12),
                        ('TRP013', 'Bhavnagar To Jamnagar', 'Bhavnagar', 'Jamnagar',218,327, 25, 26, 13),
                        ('TRP014', 'Gandhinagar To Bharuch', 'Gandhinagar', 'Bharuch',196,294, 27, 28, 14),
                        ('TRP015', 'Mehsana To Junagadh', 'Mehsana', 'Junagadh',570,855, 29, 30, 15),
                        -- ('TRP016', 'Vadodara to Jamnagar', 'Vadodara', 'Jamnagar', 31, 32, 16),
                        -- ('TRP017', 'Surat to Bhavnagar', 'Surat', 'Bhavnagar', 33, 34, 17),
                        -- ('TRP018', 'Ahmedabad to Bharuch', 'Ahmedabad', 'Bharuch', 35, 36, 18),
                        -- ('TRP019', 'Rajkot to Gandhinagar', 'Rajkot', 'Gandhinagar', 37, 38, 19),
                        -- ('TRP020', 'Vadodara to Bhavnagar', 'Vadodara', 'Bhavnagar', 39, 40, 20)
                        -- return
                        ('TRP101', 'Surat To Ahmedabad', 'Surat', 'Ahmedabad',278,417, 1, 2, 1),
                        ('TRP102', 'Rajkot To Vadodara', 'Rajkot', 'Vadodara',285,427, 3, 4, 2),
                        ('TRP103', 'Gandhinagar To Bhavnagar', 'Gandhinagar', 'Bhavnagar',186,279, 5, 6, 3),
                        ('TRP104', 'Junagadh To Jamnagar', 'Junagadh', 'Jamnagar',101,151, 7, 8, 4),
                        ('TRP105', 'Bharuch To Mehsana', 'Bharuch', 'Mehsana',201,301, 9, 10, 5),
                        ('TRP106', 'Rajkot To Surat', 'Rajkot', 'Surat',709,1063, 11, 12, 6),
                        ('TRP107', 'Vadodara To Ahmedabad', 'Vadodara', 'Ahmedabad',111,166, 13, 14, 7),
                        ('TRP108', 'Mehsana To Bhavnagar', 'Mehsana', 'Bhavnagar',331,496, 15, 16, 8),
                        ('TRP109', 'Gandhinagar To Jamnagar', 'Gandhinagar', 'Jamnagar',358,537, 17, 18, 9),
                        ('TRP110', 'Bharuch To Junagadh', 'Bharuch', 'Junagadh',599,898, 19, 20, 10),
                        ('TRP111', 'Rajkot To Ahmedabad', 'Rajkot', 'Ahmedabad',213,319, 21, 22, 11),
                        ('TRP112', 'Vadodara To Surat', 'Vadodara', 'Surat',153,229, 23, 24, 12),
                        ('TRP113', 'Jamnagar To Bhavnagar', 'Jamnagar', 'Bhavnagar',218,327, 25, 26, 13),
                        ('TRP114', 'Bharuch To Gandhinagar', 'Bharuch', 'Gandhinagar',196,294, 27, 28, 14),
                        ('TRP115', 'Junagadh To Mehsana', 'Junagadh', 'Mehsana',570,855, 29, 30, 15)
                        -- ('TRP116', 'Jamnagar to Vadodara', 'Jamnagar', 'Vadodara', 31, 32, 16),
                        -- ('TRP117', 'Bhavnagar to Surat', 'Bhavnagar', 'Surat', 33, 34, 17),
                        -- ('TRP118', 'Bharuch to Ahmedabad', 'Bharuch', 'Ahmedabad', 35, 36, 18),
                        -- ('TRP119', 'Gandhinagar to Rajkot', 'Gandhinagar', 'Rajkot', 37, 38, 19),
                        -- ('TRP120', 'Bhavnagar to Vadodara', 'Bhavnagar', 'Vadodara', 39, 40, 20);
                        ;",
                    "INSERT INTO admin ( Id,FirstName,LastName,Roll,Password)
                    VALUES
                        ('MA113666','Vedant','Bharad','MAIN ADMIN','MA113666VEDANT'),
                        ('MA116063','Meet','Butani','MAIN ADMIN','MA116063MEET'),
                        ('DEADB001','Ahmedabad','Depo','DEPO ADMIN','Ahmedabad001'),
                        ('DESUR001','Surat','Depo','DEPO ADMIN','Surat001'),
                        ('DEVAD001','Vadodara','Depo','DEPO ADMIN','Vadodara001'),
                        ('DERAJ001','Rajkot','Depo','DEPO ADMIN','Rajkot001'),
                        ('DEBHV001','Bhavnagar','Depo','DEPO ADMIN','Bhavnagar001'),
                        ('DEGAN001','Gandhinagar','Depo','DEPO ADMIN','Gandhinagar001'),
                        ('DEJAM001','Jamnagar','Depo','DEPO ADMIN','Jamnagar001'),
                        ('DEJUN001','Junagadh','Depo','DEPO ADMIN','Junagadh001'),
                        ('DEMHA001','Mehsana','Depo','DEPO ADMIN','Mehsana001'),
                        ('DEBHA001','Bharuch','Depo','DEPO ADMIN','Bharuch001'),
                        ('DEANA001','Anand','Depo','DEPO ADMIN','Anand001'),
                        ('DENAD001','Nadiad','Depo','DEPO ADMIN','Nadiad001'),
                        ('DEANK001','Ankleshwar','Depo','DEPO ADMIN','Ankleshwar001')
                        ;"
                    // "INSERT INTO `routestops` (`TripId`, `StopIndex`, `DepoId`, `ArrivalTime`, `DepatureTime`)
                    // VALUES
                    //         ('TRP001',1,1,NULL,'08:00:00'),
                    //         ('TRP001',2,3,'09:30:00','09:45:00'),
                    //         ('TRP001',3,11,'10:45:00','11:00:00'),
                    //         ('TRP001',4,12,'11:30:00','11:45:00'),
                    //         ('TRP001',5,10,'12:15:00','12:30:00'),
                    //         ('TRP001',6,13,'01:00:00','01:30:00'),

                    //         ('TRP002',1,3,NULL,'08:00:00'),
                    //         ('TRP002',2,11,'09:30:00','09:45:00'),
                    //         ('TRP002',3,12,'10:45:00','11:00:00'),
                    //         ('TRP002',4,1,'11:30:00','11:45:00'),
                    //         ('TRP002',5,10,'12:15:00','12:30:00'),
                    //         ('TRP002',6,13,'01:00:00','01:30:00'),
                    //         ;",
                        );
    foreach ($querys as $query) {
        $pdo->exec($query);
    }
    echo "DATA Added successfully" . "</br>";
} catch (PDOException $e) {
    echo $query . "<br>" . $e->getMessage() . "</br>";
}
?>