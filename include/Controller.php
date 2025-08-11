<?php
require_once('Crud.php');

class Controller
{
    private $crud;

    public function __construct()
    {
        $this->crud = new Crud();
    }

    public function registerUser($data)
    {
        $table = "users";
        $lastInsertedId = $this->crud->create($data, $table);
        return $lastInsertedId;
    }

    public function isUserRegistered($email, $conn, $username)
    {
        try {
            $query = "SELECT COUNT(*) FROM users WHERE email = :email AND username = :username";

            $stmt = $conn->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':username', $username);
            $stmt->execute();

            $count = $stmt->fetchColumn();

            return $count > 0;
        } catch (PDOException $e) {
            // Handle database query errors here
            return false;
        }
    }
    public function verifyUser($email, $password)
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        $params = array(':email' => $email);

        try {
            $result = $this->crud->read($sql, $params);

            if ($result && count($result) === 1) {
                $row = $result[0]; // Get the first row
                $storedPassword = $row['password']; // Get the stored password from the database

                // Check if the stored password is hashed
                if (password_verify($password, $storedPassword)) {
                    return $row; // Return user data
                } elseif ($password === $storedPassword) {
                    // Password matches without hashing
                    return $row; // Return user data
                } else {
                    // Incorrect password
                    return "Incorrect password";
                }
            } elseif ($result && count($result) === 0) {
                // User not found
                return "Invalid username or password";
            } else {
                // Handle database query error
                return "Database error";
            }
        } catch (Exception $e) {
            // Handle any exceptions that may occur during database interaction
            return "Error: " . $e->getMessage();
        }
    }

    public function getUserById($user_id)
    {
        $sql = "SELECT * FROM users WHERE user_id = :user_id";
        $params = array(
            ':user_id' => $user_id,

        );
        return $this->crud->read($sql, $params);
    }

    public function getStates()
    {
        $query = "SELECT * FROM `states`";
        return $this->crud->read($query);
    }

    public function property_types()
    {
        $query = "SELECT * FROM `property_types`";
        return $this->crud->read($query);
    }

    public function property_status()
    {
        $query = "SELECT * FROM `property_status`";
        return $this->crud->read($query);
    }

    public function properties($data)
    {
        $table = "properties";
        $lastInsertedId = $this->crud->create($data, $table);
        return $lastInsertedId;
    }
    public function uploaded_images($data)
    {
        $table = "uploaded_images";
        $lastInsertedId = $this->crud->create($data, $table);
        return $lastInsertedId;
    }
    public function property_features($property_id, $feature_data)
    {
        $table = "property_features";
        $dataArray = [];

        // Prepare the data array with each feature and its availability status
        foreach ($feature_data as $feature_name => $is_available) {
            $dataArray[] = [
                'property_id' => $property_id,
                'feature_name' => $feature_name,
                'is_available' => $is_available ? 1 : 0
            ];
        }

        // Insert each feature using the create method
        $lastInsertedIds = [];
        foreach ($dataArray as $data) {
            $lastInsertedIds[] = $this->crud->create($data, $table);
        }

        return $lastInsertedIds;  // Return an array of the last inserted IDs for each feature
    }

    public function updateprofile($user_id, $first_name, $last_name, $phone_no, $email, $about)
    {
        try {
            // Database update logic here
            $query = "UPDATE users SET first_name = :first_name, last_name = :last_name, phone_no = :phone_no, email = :email, about = :about, updated_at = NOW() WHERE user_id = :user_id";
            $params = [
                ':first_name' => $first_name,
                ':last_name' => $last_name,
                ':phone_no' => $phone_no,
                ':email' => $email,
                ':about' => $about,
                ':user_id' => $user_id
            ];
            $result = $this->crud->update($query, $params);
            if ($result) {
                return ['status' => 'success', 'message' => 'Profile updated successfully.'];
            } else {
                return ['status' => 'error', 'message' => 'No changes made to the profile.'];
            }
        } catch (PDOException $e) {
            return ['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()];
        } catch (Exception $e) {
            return ['status' => 'error', 'message' => 'Unexpected error: ' . $e->getMessage()];
        }
    }

    public function updateSocialLinks($user_id, $facebook_url, $twitter_url, $instagram_url)
    {
        try {
            // Prepare the SQL query
            $query = "UPDATE users 
                  SET facebook_url = :facebook_url, 
                      twitter_url = :twitter_url, 
                      instagram_url = :instagram_url, 
                      updated_at = NOW() 
                  WHERE user_id = :user_id";
            // echo $query;
            // Bind parameters
            $params = [
                ':facebook_url' => $facebook_url,
                ':twitter_url' => $twitter_url,
                ':instagram_url' => $instagram_url,
                ':user_id' => $user_id
            ];

            // Execute the update
            $result = $this->crud->update($query, $params);

            // Check for success
            if ($result) {
                return ['status' => 'success', 'message' => 'Social media links updated successfully.'];
            } else {
                return ['status' => 'error', 'message' => 'No changes made to the social media links.'];
            }
        } catch (PDOException $e) {
            return ['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()];
        } catch (Exception $e) {
            return ['status' => 'error', 'message' => 'Unexpected error: ' . $e->getMessage()];
        }
    }

    public function updatePassword($user_id, $new_password)
    {
        try {
            // Hash the password
            $hashedPassword = password_hash($new_password, PASSWORD_BCRYPT);

            // Prepare the SQL query
            $query = "UPDATE users 
                  SET password = :password, 
                      updated_at = NOW() 
                  WHERE user_id = :user_id";
            // Bind parameters
            $params = [
                ':password' => $hashedPassword,
                ':user_id' => $user_id
            ];

            // Execute the update
            $result = $this->crud->update($query, $params);

            // Check for success
            if ($result) {
                return ['status' => 'success', 'message' => 'Password updated successfully.'];
            } else {
                return ['status' => 'error', 'message' => 'Password update failed.'];
            }
        } catch (PDOException $e) {
            return ['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()];
        } catch (Exception $e) {
            return ['status' => 'error', 'message' => 'Unexpected error: ' . $e->getMessage()];
        }
    }



    public function updateProfileImage($user_id, $fileName)
    {

        // Update the user's profile image in the database
        $query = "UPDATE users SET profile_image = :profile_image WHERE user_id = :user_id";
        $params = [
            ':profile_image' => $fileName,
            ':user_id' => $user_id
        ];
        $result = $this->crud->update($query, $params);
        if ($result) {
            return ['status' => 'success', 'message' => 'Profile image updated successfully.'];
        } else {
            return ['status' => 'error', 'message' => 'Failed to update profile image in database.'];
        }
    }


    public function getMyproperties($user_id)
    {
        $query = "
            SELECT 
                p.id AS property_id,
                p.property_title,
                p.property_address,
                p.description,
                p.price,
                p.bed_room,
                p.bath_room,
                p.square_fit_min,
                p.square_fit_max,
                p.location,
                p.property_type,
                p.property_status,
                p.video_url,
                u.file_name AS image_file_name,
                u.created_at AS image_uploaded_at
            FROM 
                properties AS p
            LEFT JOIN 
                uploaded_images AS u
            ON 
                p.id = u.property_id
            WHERE 
                p.user_id = :user_id
            GROUP BY 
                p.id
            ORDER BY 
                p.created_at DESC
        ";
        $params = array(
            ':user_id' => $user_id,
        );

        return $this->crud->read($query, $params);
    }


    public function getAllProperties($offset, $limit)
    {
        $query = "
            SELECT 
                p.id AS property_id,
                p.property_title,
                p.property_address,
                p.description,
                p.price,
                p.bed_room,
                p.bath_room,
                p.square_fit_min,
                p.square_fit_max,
                p.property_status,
                p.created_at,
                p.video_url,
                u.file_name AS image_file_name
            FROM 
                properties AS p
            LEFT JOIN 
                uploaded_images AS u
            ON 
                p.id = u.property_id
            GROUP BY 
                p.id
            ORDER BY 
                p.created_at DESC
            LIMIT :offset, :limit
        ";
    
        $params = [
            ':offset' => (int) $offset,
            ':limit' => (int) $limit,
        ];
    
        return $this->crud->read($query, $params);
    }

    public function getTotalProperties()
    {
        $query = "SELECT COUNT(*) as total FROM properties";
        $result = $this->crud->read($query);

        // Return the total number of properties, or 0 if no result is found
        return $result[0]['total'] ?? 0;
    }
        

    public function getProperties($filters = [])
    {
        // Extract filters with default values
        $keyword = $filters['keyword'] ?? '';
        $location = $filters['location'] ?? '';
        $property_type = $filters['property_type'] ?? '';
        $property_status = $filters['property_status'] ?? '';
        $min_beds = $filters['min_beds'] ?? 0;
        $min_baths = $filters['min_baths'] ?? 0;
        $min_area = $filters['min_area'] ?? 0;
        $max_area = $filters['max_area'] ?? PHP_INT_MAX;
        $min_price = $filters['min_price'] ?? 0;
        $max_price = $filters['max_price'] ?? PHP_INT_MAX;
        $property_address = $filters['property_address'] ?? '';  // Add property_address filter
        $random_search = empty(array_filter($filters)); // Check if no filters are provided
        $page = $filters['page'] ?? 1;
        $limit = 4;
        $offset = ($page - 1) * $limit;
    
        // Base SQL query, including `property_address`
        $sql = "SELECT p.*, GROUP_CONCAT(i.file_name) AS images, p.property_address
                FROM properties p
                LEFT JOIN uploaded_images i ON p.id = i.property_id
                WHERE 1=1";
    
        // Parameters array
        $params = [];
    
        // Advanced search filters
        if (!$random_search) {
            if (!empty($keyword)) {
                $sql .= " AND (p.property_title LIKE ? OR p.description LIKE ? OR p.keyword LIKE ?)";
                $keyword_param = '%' . $keyword . '%';
                $params[] = $keyword_param;
                $params[] = $keyword_param;
                $params[] = $keyword_param;
            }
    
            if (!empty($location)) {
                $sql .= " AND p.location LIKE ?";
                $params[] = '%' . $location . '%';
            }
    
            if (!empty($property_type)) {
                $sql .= " AND p.property_type = ?";
                $params[] = $property_type;
            }
    
            if (!empty($property_status)) {
                $sql .= " AND p.property_status = ?";
                $params[] = $property_status;
            }
    
            if (!empty($property_address)) { // Only add this filter if it's not empty
                $sql .= " AND p.property_address LIKE ?";
                $params[] = '%' . $property_address . '%';
            }
    
            $sql .= " AND p.bed_room >= ?";
            $params[] = $min_beds;
    
            $sql .= " AND p.bath_room >= ?";
            $params[] = $min_baths;
    
            $sql .= " AND (p.square_fit_min >= ? OR p.square_fit_max <= ?)";
            $params[] = $min_area;
            $params[] = $max_area;
    
            $sql .= " AND p.price BETWEEN ? AND ?";
            $params[] = $min_price;
            $params[] = $max_price;
        } else {
            // Fetch random properties if no filters are provided
            $sql .= " ORDER BY RAND()";
        }
    
        // Group by property ID for images aggregation
        $sql .= " GROUP BY p.id";
    
        // Pagination
        $sql .= " LIMIT ? OFFSET ?";
        $params[] = $limit;
        $params[] = $offset;
    
        // Debugging: print the SQL query and parameters
        // echo "SQL Query: " . $sql . "\n";
        // echo "Parameters: " . print_r($params, true) . "\n";
    
        // Execute the query
        $result = $this->crud->read($sql, $params);
        $data = [];
        if ($result && count($result) > 0) {
            foreach ($result as $row) {
                // Split the images into an array
                $row['images'] = $row['images'] ? explode(',', $row['images']) : [];
                $data[] = $row;
            }
        }
    
        // Total count for pagination
        $count_sql = "SELECT COUNT(DISTINCT p.id) AS total
                      FROM properties p
                      LEFT JOIN uploaded_images i ON p.id = i.property_id
                      WHERE 1=1";
    
        $count_params = [];
    
        if (!$random_search) {
            if (!empty($keyword)) {
                $count_sql .= " AND (p.property_title LIKE ? OR p.description LIKE ? OR p.keyword LIKE ?)";
                $count_params[] = $keyword_param;
                $count_params[] = $keyword_param;
                $count_params[] = $keyword_param;
            }
    
            if (!empty($location)) {
                $count_sql .= " AND p.location LIKE ?";
                $count_params[] = '%' . $location . '%';
            }
    
            if (!empty($property_type)) {
                $count_sql .= " AND p.property_type = ?";
                $count_params[] = $property_type;
            }
    
            if (!empty($property_status)) {
                $count_sql .= " AND p.property_status = ?";
                $count_params[] = $property_status;
            }
    
            if (!empty($property_address)) { // Only add this filter if it's not empty
                $count_sql .= " AND p.property_address LIKE ?";
                $count_params[] = '%' . $property_address . '%';
            }
    
            $count_sql .= " AND p.bed_room >= ?";
            $count_params[] = $min_beds;
    
            $count_sql .= " AND p.bath_room >= ?";
            $count_params[] = $min_baths;
    
            $count_sql .= " AND (p.square_fit_min >= ? OR p.square_fit_max <= ?)";
            $count_params[] = $min_area;
            $count_params[] = $max_area;
    
            $count_sql .= " AND p.price BETWEEN ? AND ?";
            $count_params[] = $min_price;
            $count_params[] = $max_price;
        }
    
        $total = $this->crud->read($count_sql, $count_params);
    
        return [
            'data' => $data,
            'total' => $total,
            'page' => $page,
            'limit' => $limit
        ];
    }
    
    
    public function gg(){}
  
   
//     public function getProperties($filters = [])
// {
//     // Extract filters with default values
//     $keyword = $filters['keyword'] ?? '';
//     $location = $filters['location'] ?? '';
//     $property_type = $filters['property_type'] ?? '';
//     $property_status = $filters['property_status'] ?? '';
//     $min_beds = $filters['min_beds'] ?? 0;
//     $min_baths = $filters['min_baths'] ?? 0;
//     $min_area = $filters['min_area'] ?? 0;
//     $max_area = $filters['max_area'] ?? PHP_INT_MAX;
//     $min_price = $filters['min_price'] ?? 0;
//     $max_price = $filters['max_price'] ?? PHP_INT_MAX;
//     $random_search = empty(array_filter($filters)); // Check if no filters are provided
//     $page = $filters['page'] ?? 1;
//     $limit = 4;
//     $offset = ($page - 1) * $limit;

//     // Base SQL query
//     $sql = "SELECT p.*, GROUP_CONCAT(i.file_name) AS images 
//             FROM properties p
//             LEFT JOIN uploaded_images i ON p.id = i.property_id
//             WHERE 1=1";

//     // Parameters array
//     $params = [];

//     // Advanced search filters
//     if (!$random_search) {
//         if (!empty($keyword)) {
//             $sql .= " AND (p.property_title LIKE ? OR p.description LIKE ? OR p.keyword LIKE ?)";
//             $keyword_param = '%' . $keyword . '%';
//             $params[] = $keyword_param;
//             $params[] = $keyword_param;
//             $params[] = $keyword_param;
//         }

        
//         if (!empty($location)) {
//             $sql .= " AND p.location LIKE ?";
//             $params[] = '%' . $location . '%';
//         }

//         if (!empty($property_type)) {
//             $sql .= " AND p.property_type = ?";
//             $params[] = $property_type;
//         }

//         if (!empty($property_status)) {
//             $sql .= " AND p.property_status = ?";
//             $params[] = $property_status;
//         }

//         $sql .= " AND p.bed_room >= ?";
//         $params[] = $min_beds;

//         $sql .= " AND p.bath_room >= ?";
//         $params[] = $min_baths;

//         $sql .= " AND (p.square_fit_min >= ? OR p.square_fit_max <= ?)";
//         $params[] = $min_area;
//         $params[] = $max_area;

//         $sql .= " AND p.price BETWEEN ? AND ?";
//         $params[] = $min_price;
//         $params[] = $max_price;
//     } else {
//         // Fetch random properties if no filters are provided
//         $sql .= " ORDER BY RAND()";
//     }

//     // Group by property ID for images aggregation
//     $sql .= " GROUP BY p.id";

//     // Pagination
//     $sql .= " LIMIT ? OFFSET ?";
//     $params[] = $limit;
//     $params[] = $offset;

//     // Execute the query
//     $result = $this->crud->read($sql, $params);
//     $data = [];
//     if ($result && count($result) > 0) {
//         foreach ($result as $row) {
//             // Split the images into an array
//             $row['images'] = $row['images'] ? explode(',', $row['images']) : [];
//             $data[] = $row;
//         }
//     }

//     // Total count for pagination
//     $count_sql = "SELECT COUNT(DISTINCT p.id) AS total
//                   FROM properties p
//                   LEFT JOIN uploaded_images i ON p.id = i.property_id
//                   WHERE 1=1";

//     $count_params = [];

//     if (!$random_search) {
//         if (!empty($keyword)) {
//             $count_sql .= " AND (p.property_title LIKE ? OR p.description LIKE ? OR p.keyword LIKE ?)";
//             $count_params[] = $keyword_param;
//             $count_params[] = $keyword_param;
//             $count_params[] = $keyword_param;
//         }

//         if (!empty($location)) {
//             $count_sql .= " AND p.location LIKE ?";
//             $count_params[] = '%' . $location . '%';
//         }

//         if (!empty($property_type)) {
//             $count_sql .= " AND p.property_type = ?";
//             $count_params[] = $property_type;
//         }

//         if (!empty($property_status)) {
//             $count_sql .= " AND p.property_status = ?";
//             $count_params[] = $property_status;
//         }

//         $count_sql .= " AND p.bed_room >= ?";
//         $count_params[] = $min_beds;

//         $count_sql .= " AND p.bath_room >= ?";
//         $count_params[] = $min_baths;

//         $count_sql .= " AND (p.square_fit_min >= ? OR p.square_fit_max <= ?)";
//         $count_params[] = $min_area;
//         $count_params[] = $max_area;

//         $count_sql .= " AND p.price BETWEEN ? AND ?";
//         $count_params[] = $min_price;
//         $count_params[] = $max_price;
//     }

//     $count_result = $this->crud->read($count_sql, $count_params);
//     $total_count = $count_result[0]['total'] ?? 0;

//     // Return response
//     return [
//         'data' => $data,
//         'total' => $total_count,
//         'limit' => $limit,
//         'page' => $page,
//     ];
// }

    public function getRecentProperties()
{
    // SQL Query to fetch the 4 most recent properties
    $query = "
        SELECT 
            p.id, 
            p.property_title, 
            p.property_address, 
            p.description, 
            p.keyword, 
            p.location, 
            p.property_type, 
            p.property_status, 
            p.bed_room, 
            p.bath_room, 
            p.square_fit_min, 
            p.square_fit_max, 
            p.price, 
            p.video_url, 
            p.user_id, 
            p.created_at, 
            GROUP_CONCAT(i.file_name) AS images 
        FROM 
            properties p
        LEFT JOIN 
            uploaded_images i ON p.id = i.property_id
        GROUP BY 
            p.id
        ORDER BY 
            p.created_at DESC
        LIMIT 4
    ";

    // Execute the query using the CRUD method
    $result = $this->crud->read($query);

    // Return the fetched results
    return $result;
}
     
    public function getRecentPropertiesLimitTen(): array
{
    $query = "
        SELECT 
            p.id, 
            p.property_title, 
            p.property_address, 
            p.description, 
            p.keyword, 
            p.location, 
            p.property_type, 
            p.property_status, 
            p.bed_room, 
            p.bath_room, 
            p.square_fit_min, 
            p.square_fit_max, 
            p.price, 
            p.video_url, 
            p.user_id, 
            p.created_at, 
            GROUP_CONCAT(i.file_name) AS images 
        FROM 
            properties p
        LEFT JOIN 
            uploaded_images i ON p.id = i.property_id
        GROUP BY 
            p.id
        ORDER BY 
            p.created_at DESC
            LIMIT 10
    ";

    // Execute the query using the CRUD method
    $result = $this->crud->read($query);

    // Return the fetched results
    return $result;
}
     

public function getPropertyById($propertyId)
{
    $query = "
        SELECT 
            p.id AS property_id,
            p.property_title,
            p.property_address,
            p.description,
            p.price,
            p.bed_room,
            p.bath_room,
            p.square_fit_min,
            p.square_fit_max,
            p.property_status,
            p.created_at,
            p.video_url,
            GROUP_CONCAT(DISTINCT u.file_name) AS image_files,
            GROUP_CONCAT(DISTINCT CASE WHEN pf.is_available = 1 THEN pf.feature_name ELSE NULL END) AS available_features,
            us.user_id,
            CONCAT(us.first_name, ' ', us.last_name) AS user_full_name,
            us.email AS user_email,
            us.phone_no AS user_phone,
            us.profile_image AS user_profile_image,
            us.about AS user_about,
            us.facebook_url,
            us.twitter_url,
            us.instagram_url
        FROM 
            properties AS p
        LEFT JOIN 
            uploaded_images AS u ON p.id = u.property_id
        LEFT JOIN 
            property_features AS pf ON p.id = pf.property_id
        LEFT JOIN 
            users AS us ON p.user_id = us.user_id
        WHERE 
            p.id = :property_id
        GROUP BY 
            p.id
    ";

    // Prepare the parameters for the query
    $params = [
        ':property_id' => (int) $propertyId,
    ];

    return $this->crud->read($query, $params);
}




    
}
