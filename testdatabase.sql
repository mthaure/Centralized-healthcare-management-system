-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 15, 2025 at 10:38 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `testdatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `Appointment_ID` int(11) NOT NULL,
  `Patient_ID` int(11) NOT NULL,
  `Doctor_ID` int(11) NOT NULL,
  `Appointment_Date` date NOT NULL,
  `Appointment_Time` time NOT NULL,
  `Reason` varchar(255) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cpt_codes`
--

CREATE TABLE `cpt_codes` (
  `cpt_code` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cpt_codes`
--

INSERT INTO `cpt_codes` (`cpt_code`, `description`, `amount`) VALUES
(36415, 'Collection of venous blood by venipuncture', 450.00),
(71045, 'Chest X-ray, single view', 250.00),
(71046, 'Chest X-ray, 2 views', 450.00),
(71047, 'Chest X-ray, 3 views', 800.00);

-- --------------------------------------------------------

--
-- Table structure for table `department_details`
--

CREATE TABLE `department_details` (
  `Department_ID` int(11) NOT NULL,
  `Department_Name` varchar(50) NOT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `Contact_Number` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department_details`
--

INSERT INTO `department_details` (`Department_ID`, `Department_Name`, `Description`, `Contact_Number`) VALUES
(1, 'Cardiology', 'Heart and blood vessel health', '123-456-7890'),
(2, 'Neurology', 'Nervous system disorders', '234-567-8901'),
(3, 'Pediatrics', 'Child healthcare', '345-678-9012'),
(4, 'Orthopedics', 'Bone and joint health', '456-789-0123'),
(5, 'Dermatology', 'Skin-related issues', '567-890-1234'),
(6, 'Psychiatry', 'Mental health services', '678-901-2345');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `Doctor_ID` int(11) NOT NULL,
  `Doctor_SSN` varchar(12) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Phone_Number` varchar(15) NOT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Work_Hours` varchar(100) DEFAULT NULL,
  `Is_Active` tinyint(1) DEFAULT 1,
  `Department_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`Doctor_ID`, `Doctor_SSN`, `Name`, `Phone_Number`, `Email`, `Work_Hours`, `Is_Active`, `Department_ID`) VALUES
(2, '654-65-4654', 'Michael Thaure', '650-302-3008', 'mthaure5@gmail.com', '06:54-18:54', 1, 1),
(3, '897-65-4321', 'Tom Smith', '897-465-4654', 'tom@gmail.com', '02:31-15:42', 1, 4),
(4, '978-97-4658', 'Dr. Tim Haley', '897-847-6546', 'taco@gmail.com', '9:00 AM - 5:00 PM', 1, 4),
(5, '978-97-4658', 'fdsdfsgfds', '874-654-6565', 'mthaure5@gmail.com', '9:00 AM - 5:00 PM', 1, 2),
(6, '978-97-4658', 'fdsdfsgfds', '874-654-6565', 'mthaure5@gmail.com', '9:00 AM - 5:00 PM', 1, 1),
(7, '978-97-4658', 'fdsdfsgfds', '874-654-6565', 'mthaure5@gmail.com', '9:00 AM - 5:00 PM', 1, 1),
(8, '978-97-4658', 'fdsdfsgfds', '874-654-6565', 'mthaure5@gmail.com', '9:00 AM - 5:00 PM', 1, 3),
(10, '687-54-6546', 'James Kim', '874-683-4132', 'taco@gmail.com', '9:00 AM - 5:00 PM', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `doctor_prescription`
--

CREATE TABLE `doctor_prescription` (
  `Prescription_ID` int(11) NOT NULL,
  `Patient_ID` int(11) NOT NULL,
  `Prescription_Date` date DEFAULT NULL,
  `Doctor_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doctor_specialization`
--

CREATE TABLE `doctor_specialization` (
  `Doctor_ID` int(11) NOT NULL,
  `Specialization_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctor_specialization`
--

INSERT INTO `doctor_specialization` (`Doctor_ID`, `Specialization_ID`) VALUES
(10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `insurance`
--

CREATE TABLE `insurance` (
  `Company_ID` int(11) NOT NULL,
  `Company_Name` varchar(100) NOT NULL,
  `Phone_Number` varchar(15) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Is_Active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `insurance`
--

INSERT INTO `insurance` (`Company_ID`, `Company_Name`, `Phone_Number`, `Address`, `Email`, `Is_Active`) VALUES
(1, 'HealthFirst Insurance', '123-456-7890', '123 Main St, Cityville', 'contact@healthfirst.com', 1),
(2, 'WellCare Insurance', '987-654-3210', '456 Oak Ave, Townsville', 'info@wellcare.com', 1),
(3, 'PrimeCare Insurance', '555-123-4567', '789 Maple Blvd, Metropolis', 'support@primecare.com', 1),
(4, 'CarePlus Health', '111-222-3333', '321 Elm St, Cityville', 'help@careplus.com', 1),
(5, 'MediSure Insurance', '444-555-6666', '654 Pine Rd, Villagetown', 'services@medisure.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `Invoice_Number` int(11) NOT NULL,
  `Patient_ID` int(11) NOT NULL,
  `cpt_code` int(11) NOT NULL,
  `Amount` decimal(10,2) NOT NULL,
  `Invoice_Date` date DEFAULT NULL,
  `Prescription_ID` int(11) NOT NULL,
  `Doctor_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `Patient_ID` int(11) NOT NULL,
  `Patient_SSN` varchar(11) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Gender` enum('Male','Female','Other','Prefer not to say') NOT NULL,
  `Date_of_Birth` date DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `Emergency_Contact` varchar(100) DEFAULT NULL,
  `Medical_History` text DEFAULT NULL,
  `Is_Active` tinyint(1) DEFAULT 1,
  `Phone_Number` varchar(15) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Allergies` text DEFAULT NULL,
  `Preferred_Language` varchar(50) DEFAULT NULL,
  `Date_Registered` date DEFAULT curdate(),
  `Notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient_doctor`
--

CREATE TABLE `patient_doctor` (
  `Patient_ID` int(11) NOT NULL,
  `Doctor_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient_insurance`
--

CREATE TABLE `patient_insurance` (
  `Patient_Insurance_ID` int(11) NOT NULL,
  `Patient_ID` int(11) NOT NULL,
  `Company_ID` int(11) NOT NULL,
  `Insurance_Serial_Number` varchar(60) DEFAULT NULL,
  `Insurance_Expiry_Date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `Payment_ID` int(11) NOT NULL,
  `Patient_ID` int(11) NOT NULL,
  `Invoice_Number` int(11) NOT NULL,
  `Amount` decimal(10,2) NOT NULL,
  `Payment_Date` date NOT NULL,
  `Payment_Method` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `specializations`
--

CREATE TABLE `specializations` (
  `Specialization_ID` int(11) NOT NULL,
  `Specialization` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `specializations`
--

INSERT INTO `specializations` (`Specialization_ID`, `Specialization`) VALUES
(1, 'Cardiologist'),
(2, 'Neurologist'),
(3, 'Pediatrician'),
(4, 'Orthopedic Surgeon'),
(5, 'Dermatologist'),
(6, 'Psychiatrist');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`Appointment_ID`),
  ADD KEY `fk_appointments_patient` (`Patient_ID`),
  ADD KEY `fk_appointments_doctor` (`Doctor_ID`);

--
-- Indexes for table `cpt_codes`
--
ALTER TABLE `cpt_codes`
  ADD PRIMARY KEY (`cpt_code`);

--
-- Indexes for table `department_details`
--
ALTER TABLE `department_details`
  ADD PRIMARY KEY (`Department_ID`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`Doctor_ID`),
  ADD KEY `doctor_ibfk_1` (`Department_ID`);

--
-- Indexes for table `doctor_prescription`
--
ALTER TABLE `doctor_prescription`
  ADD PRIMARY KEY (`Prescription_ID`),
  ADD KEY `doctor_prescription_ibfk_1` (`Doctor_ID`),
  ADD KEY `doctor_prescription_ibfk_2` (`Patient_ID`);

--
-- Indexes for table `doctor_specialization`
--
ALTER TABLE `doctor_specialization`
  ADD PRIMARY KEY (`Doctor_ID`,`Specialization_ID`),
  ADD KEY `doctor_specialization_ibfk_2` (`Specialization_ID`);

--
-- Indexes for table `insurance`
--
ALTER TABLE `insurance`
  ADD PRIMARY KEY (`Company_ID`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`Invoice_Number`),
  ADD KEY `invoice_ibfk_1` (`Patient_ID`),
  ADD KEY `invoice_ibfk_3` (`Prescription_ID`),
  ADD KEY `invoice_ibfk_4` (`Doctor_ID`),
  ADD KEY `invoice_ibfk_5` (`cpt_code`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`Patient_ID`),
  ADD UNIQUE KEY `unique_ssn` (`Patient_SSN`);

--
-- Indexes for table `patient_doctor`
--
ALTER TABLE `patient_doctor`
  ADD PRIMARY KEY (`Patient_ID`,`Doctor_ID`),
  ADD KEY `patient_doctor_ibfk_2` (`Doctor_ID`);

--
-- Indexes for table `patient_insurance`
--
ALTER TABLE `patient_insurance`
  ADD PRIMARY KEY (`Patient_Insurance_ID`),
  ADD KEY `patient_insurance_ibfk_1` (`Patient_ID`),
  ADD KEY `patient_insurance_ibfk_2` (`Company_ID`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`Payment_ID`),
  ADD KEY `payments_ibfk_1` (`Invoice_Number`),
  ADD KEY `payments_ibfk_2` (`Patient_ID`);

--
-- Indexes for table `specializations`
--
ALTER TABLE `specializations`
  ADD PRIMARY KEY (`Specialization_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `Appointment_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `department_details`
--
ALTER TABLE `department_details`
  MODIFY `Department_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `Doctor_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `doctor_prescription`
--
ALTER TABLE `doctor_prescription`
  MODIFY `Prescription_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `insurance`
--
ALTER TABLE `insurance`
  MODIFY `Company_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `Invoice_Number` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `Patient_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient_insurance`
--
ALTER TABLE `patient_insurance`
  MODIFY `Patient_Insurance_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `Payment_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `specializations`
--
ALTER TABLE `specializations`
  MODIFY `Specialization_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `fk_appointments_doctor` FOREIGN KEY (`Doctor_ID`) REFERENCES `doctor` (`Doctor_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_appointments_patient` FOREIGN KEY (`Patient_ID`) REFERENCES `patient` (`Patient_ID`) ON UPDATE CASCADE;

--
-- Constraints for table `doctor`
--
ALTER TABLE `doctor`
  ADD CONSTRAINT `doctor_ibfk_1` FOREIGN KEY (`Department_ID`) REFERENCES `department_details` (`Department_ID`) ON UPDATE CASCADE;

--
-- Constraints for table `doctor_prescription`
--
ALTER TABLE `doctor_prescription`
  ADD CONSTRAINT `doctor_prescription_ibfk_1` FOREIGN KEY (`Doctor_ID`) REFERENCES `doctor` (`Doctor_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `doctor_prescription_ibfk_2` FOREIGN KEY (`Patient_ID`) REFERENCES `patient` (`Patient_ID`) ON UPDATE CASCADE;

--
-- Constraints for table `doctor_specialization`
--
ALTER TABLE `doctor_specialization`
  ADD CONSTRAINT `doctor_specialization_ibfk_1` FOREIGN KEY (`Doctor_ID`) REFERENCES `doctor` (`Doctor_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `doctor_specialization_ibfk_2` FOREIGN KEY (`Specialization_ID`) REFERENCES `specializations` (`Specialization_ID`) ON UPDATE CASCADE;

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `invoice_ibfk_1` FOREIGN KEY (`Patient_ID`) REFERENCES `patient` (`Patient_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `invoice_ibfk_3` FOREIGN KEY (`Prescription_ID`) REFERENCES `doctor_prescription` (`Prescription_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `invoice_ibfk_4` FOREIGN KEY (`Doctor_ID`) REFERENCES `doctor` (`Doctor_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `invoice_ibfk_5` FOREIGN KEY (`cpt_code`) REFERENCES `cpt_codes` (`cpt_code`);

--
-- Constraints for table `patient_doctor`
--
ALTER TABLE `patient_doctor`
  ADD CONSTRAINT `patient_doctor_ibfk_1` FOREIGN KEY (`Patient_ID`) REFERENCES `patient` (`Patient_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `patient_doctor_ibfk_2` FOREIGN KEY (`Doctor_ID`) REFERENCES `doctor` (`Doctor_ID`) ON UPDATE CASCADE;

--
-- Constraints for table `patient_insurance`
--
ALTER TABLE `patient_insurance`
  ADD CONSTRAINT `patient_insurance_ibfk_1` FOREIGN KEY (`Patient_ID`) REFERENCES `patient` (`Patient_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `patient_insurance_ibfk_2` FOREIGN KEY (`Company_ID`) REFERENCES `insurance` (`Company_ID`) ON UPDATE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`Invoice_Number`) REFERENCES `invoice` (`Invoice_Number`) ON UPDATE CASCADE,
  ADD CONSTRAINT `payments_ibfk_2` FOREIGN KEY (`Patient_ID`) REFERENCES `patient` (`Patient_ID`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
