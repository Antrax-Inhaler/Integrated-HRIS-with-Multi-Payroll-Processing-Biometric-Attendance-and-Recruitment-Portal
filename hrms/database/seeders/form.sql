CREATE TABLE personal_information (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cs_id_no VARCHAR(50),                     -- CS ID No.
    surname VARCHAR(100),                     -- Surname
    first_name VARCHAR(100),                  -- First Name
    middle_name VARCHAR(100),                 -- Middle Name
    name_extension VARCHAR(10),               -- Name Extension (JR, SR, etc.)
    date_of_birth DATE,                       -- Date of Birth
    place_of_birth VARCHAR(255),              -- Place of Birth
    sex ENUM('Male', 'Female'),               -- Sex
    civil_status ENUM('Single', 'Married', 'Widowed', 'Separated', 'Other'), -- Civil Status
    citizenship VARCHAR(100),                 -- Citizenship
    dual_citizenship_country VARCHAR(100),     -- Country for dual citizenship
    dual_citizenship_by ENUM('By birth', 'By naturalization'), -- How dual citizenship was obtained
    
    -- Residential Address Breakdown
    residential_house_no VARCHAR(50),         -- House/Block/Lot No.
    residential_street VARCHAR(255),          -- Street
    residential_subdivision VARCHAR(255),     -- Subdivision/Village
    residential_barangay VARCHAR(255),        -- Barangay
    residential_city_municipality VARCHAR(255), -- City/Municipality
    residential_province VARCHAR(255),        -- Province
    residential_zip_code VARCHAR(10),         -- Zip Code
    
    -- Permanent Address Breakdown
    permanent_house_no VARCHAR(50),           -- House/Block/Lot No.
    permanent_street VARCHAR(255),            -- Street
    permanent_subdivision VARCHAR(255),       -- Subdivision/Village
    permanent_barangay VARCHAR(255),          -- Barangay
    permanent_city_municipality VARCHAR(255), -- City/Municipality
    permanent_province VARCHAR(255),          -- Province
    permanent_zip_code VARCHAR(10),           -- Zip Code

    telephone_no VARCHAR(15),                 -- Telephone No.
    mobile_no VARCHAR(15),                    -- Mobile No.
    email_address VARCHAR(100),               -- E-mail Address
    height DECIMAL(4,2),                      -- Height (in meters)
    weight DECIMAL(5,2),                      -- Weight (in kilograms)
    blood_type VARCHAR(5),                    -- Blood Type
    gsis_no VARCHAR(50),                      -- GSIS No.
    pagibig_no VARCHAR(50),                   -- PAG-IBIG No.
    philhealth_no VARCHAR(50),                -- PhilHealth No.
    sss_no VARCHAR(50),                       -- SSS No.
    tin_no VARCHAR(50),                       -- TIN No.
    agency_employee_no VARCHAR(50),           -- Agency Employee No.
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE educational_background (
    id INT AUTO_INCREMENT PRIMARY KEY,
    personal_id INT,                          -- Foreign Key from personal_information
     applicant_id BIGINT(20) UNSIGNED,
    level ENUM('Elementary', 'Secondary', 'Vocational', 'College', 'Graduate Studies'), -- Education Level
    school_name VARCHAR(255),                 -- School Name
    period_of_attendance_from YEAR,           -- Period of Attendance (From Year)
    period_of_attendance_to YEAR,             -- Period of Attendance (To Year)
    course_name VARCHAR(255),                 -- Course (if applicable)
    year_graduated YEAR,                      -- Year Graduated
    highest_level_units_earned VARCHAR(50),   -- Highest Level / Units Earned (if not graduated)
    honors_received VARCHAR(255),             -- Academic Honors (if any)
    FOREIGN KEY (personal_id) REFERENCES personal_information(id)
);
CREATE TABLE work_experience (
    id INT AUTO_INCREMENT PRIMARY KEY,
    position_title VARCHAR(100),              -- Position Title
    department VARCHAR(100),                  -- Department/Agency/Office/Company
    monthly_salary DECIMAL(10,2),             -- Monthly Salary
    salary_grade_step VARCHAR(50),            -- Salary/Job/Pay Grade (SG) & Step (if applicable)
    status_of_appointment VARCHAR(100),       -- Status of Appointment
    government_service ENUM('Yes', 'No'),     -- Whether Government Service or not
    inclusive_dates_from DATE,                -- Inclusive Dates (From)
    inclusive_dates_to DATE,                  -- Inclusive Dates (To)
);

CREATE TABLE civil_service_eligibility (
    id INT AUTO_INCREMENT PRIMARY KEY,
    personal_id INT,                          -- Foreign Key from personal_information
    career_service VARCHAR(255),              -- Career Service/RA 1080/Board/Bar Under Special Laws
    rating DECIMAL(5,2),                      -- Rating (if applicable)
    date_of_examination DATE,                 -- Date of Examination/Conferment
    place_of_examination VARCHAR(255),        -- Place of Examination/Conferment
    license_number VARCHAR(100),              -- License Number (if applicable)
    license_validity DATE,                    -- License Validity
    FOREIGN KEY (personal_id) REFERENCES personal_information(id)
);
CREATE TABLE voluntary_work (
    id INT AUTO_INCREMENT PRIMARY KEY,
    applicant_id INT,                         
    organization_name VARCHAR(255),           -- Name of the organization
    organization_address VARCHAR(255),        -- Address of the organization
    position_nature_of_work VARCHAR(255),     -- Position / Nature of Work
    inclusive_dates_from DATE,                -- Inclusive Dates (From)
    inclusive_dates_to DATE,                  -- Inclusive Dates (To)
    number_of_hours INT,                      -- Number of Hours worked
    FOREIGN KEY (personal_id) REFERENCES personal_information(id)
);
CREATE TABLE learning_development (
    id INT AUTO_INCREMENT PRIMARY KEY,
    personal_id INT,                          -- Foreign Key from personal_information
    title_of_program VARCHAR(255),            -- Title of Learning/Development Program
    type_of_ld ENUM('Managerial', 'Supervisory', 'Technical', 'Other'), -- Type of LD
    conducted_by VARCHAR(255),                -- Conducted/Sponsored By
    inclusive_dates_from DATE,                -- Inclusive Dates (From)
    inclusive_dates_to DATE,                  -- Inclusive Dates (To)
    number_of_hours INT,                      -- Number of Hours
    FOREIGN KEY (personal_id) REFERENCES personal_information(id)
);
CREATE TABLE other_information (
    id INT AUTO_INCREMENT PRIMARY KEY,
    personal_id INT,                          -- Foreign Key from personal_information
    type ENUM('Special Skill or Hobby', 'Non-Academic Distinction', 'Membership'),  -- Type of Information
    description VARCHAR(255),                 -- Description (Skill/Hobby, Distinction, or Membership Organization)
    FOREIGN KEY (personal_id) REFERENCES personal_information(id)
);
-- Table for legal/criminal and other questionnaire data
CREATE TABLE legal_questionnaire (
    id INT AUTO_INCREMENT PRIMARY KEY,
    applicant_id BIGINT(20) UNSIGNED,         -- Foreign key from applicants table
    personal_id INT,  -- Foreign Key from personal_information
    relation_within_third_degree BOOLEAN,
    relation_within_fourth_degree BOOLEAN,
    found_guilty_admin_offense BOOLEAN,
    guilty_admin_details TEXT,
    criminally_charged BOOLEAN,
    criminal_case_details TEXT,
    criminal_case_filed_date DATE,
    criminal_case_status VARCHAR(255),
    convicted_any_crime BOOLEAN,
    convicted_crime_details TEXT,
    separated_from_service BOOLEAN,
    separation_details TEXT,
    candidate_in_election BOOLEAN,
    election_candidate_details TEXT,
    resigned_before_election BOOLEAN,
    election_resignation_details TEXT,
    immigrant_status BOOLEAN,
    immigrant_country_details TEXT,
    member_of_indigenous_group BOOLEAN,
    indigenous_group_details TEXT,
    person_with_disability BOOLEAN,
    disability_id_number VARCHAR(50),
    solo_parent BOOLEAN,
    solo_parent_id_number VARCHAR(50),
    FOREIGN KEY (personal_id) REFERENCES personal_information(id)
);

-- Table for references
CREATE TABLE references (
    id INT AUTO_INCREMENT PRIMARY KEY,
    personal_id INT,  -- Foreign Key from personal_information
    reference_name VARCHAR(255),
    reference_address VARCHAR(255),
    reference_telephone VARCHAR(50),
    FOREIGN KEY (personal_id) REFERENCES personal_information(id)
);

CREATE TABLE legal_questionnaire (
    id INT AUTO_INCREMENT PRIMARY KEY,
    applicant_id BIGINT(20) UNSIGNED,         -- Foreign key from applicants table
    
    -- Question 34: Relation by consanguinity or affinity
    related_to_authority_within_third_degree BOOLEAN,
    related_to_authority_within_fourth_degree BOOLEAN,
    relation_details VARCHAR(255),
    
    -- Question 35: Administrative offenses
    found_guilty_of_offense BOOLEAN,
    offense_details VARCHAR(255),
    
    -- Criminal charges
    criminally_charged BOOLEAN,
    criminal_charge_details VARCHAR(255),
    criminal_charge_date DATE,
    criminal_charge_status VARCHAR(100),
    
    -- Question 36: Convicted of crime
    convicted_of_crime BOOLEAN,
    conviction_details VARCHAR(255),
    
    -- Question 37: Separation from service
    separated_from_service BOOLEAN,
    separation_details VARCHAR(255),
    
    -- Question 38: Election candidacy
    election_candidate BOOLEAN,
    election_details VARCHAR(255),
    
    -- Resigned for election campaign
    resigned_for_campaign BOOLEAN,
    resignation_details VARCHAR(255),
    
    -- Question 39: Immigrant or permanent resident
    immigrant_status BOOLEAN,
    immigrant_country VARCHAR(100),
    
    -- Question 40: Indigenous group, disabled, solo parent
    indigenous_group_member BOOLEAN,
    indigenous_group_details VARCHAR(100),
    person_with_disability BOOLEAN,
    disability_id_number VARCHAR(100),
    solo_parent BOOLEAN,
    solo_parent_id_number VARCHAR(100),

     -- Government Issued ID
    government_id_type VARCHAR(100),  -- Type of ID (e.g., Passport, Driver's License, etc.)
    government_id_number VARCHAR(100),  -- ID/License/Passport Number
    id_issuance_date DATE,  -- Date of Issuance
    id_issuance_place VARCHAR(100),  -- Place of Issuance
    
    -- Signature and thumbmark
    signature VARCHAR(255),  -- Placeholder for signature data (could be binary or path if stored as an image)
    date_accomplished DATE,  -- Date the form was completed
    right_thumbmark BLOB,  -- Placeholder for storing thumbmark data (binary if stored as an image)
    
    -- Oath section
    date_sworn DATE,  -- Date of the oath
    person_administering_oath VARCHAR(100),  -- Name of the person administering the oath
    
    -- Created and updated timestamps
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_legal_questionnaire_applicant FOREIGN KEY (applicant_id) REFERENCES applicants(id) ON DELETE CASCADE
);
CREATE TABLE family_background (
    id INT AUTO_INCREMENT PRIMARY KEY,
    spouse_surname VARCHAR(100),              -- Spouse's Surname
    spouse_first_name VARCHAR(100),           -- Spouse's First Name
    spouse_middle_name VARCHAR(100),          -- Spouse's Middle Name
    spouse_occupation VARCHAR(100),           -- Spouse's Occupation
    spouse_employer_name VARCHAR(100),        -- Spouse's Employer/Business Name
    spouse_business_address VARCHAR(255),     -- Spouse's Business Address
    spouse_telephone_no VARCHAR(15),          -- Spouse's Telephone No.
    father_surname VARCHAR(100),              -- Father's Surname
    father_first_name VARCHAR(100),           -- Father's First Name
    father_middle_name VARCHAR(100),          -- Father's Middle Name
    mother_maiden_name VARCHAR(255),          -- Mother's Maiden Name
    FOREIGN KEY (personal_id) REFERENCES personal_information(id)
);
CREATE TABLE children (
    id INT AUTO_INCREMENT PRIMARY KEY,
    child_name VARCHAR(255),                  -- Child's Full Name
    date_of_birth DATE,                       -- Child's Date of Birth
    FOREIGN KEY (personal_id) REFERENCES personal_information(id)
);
