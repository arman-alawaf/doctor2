-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 23, 2025 at 12:41 PM
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
-- Database: `armansha_doctor`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_id` bigint(20) UNSIGNED NOT NULL,
  `doctor_id` bigint(20) UNSIGNED NOT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` time NOT NULL,
  `status` enum('pending','confirmed','cancelled','completed') NOT NULL DEFAULT 'pending',
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `patient_id`, `doctor_id`, `appointment_date`, `appointment_time`, `status`, `notes`, `created_at`, `updated_at`) VALUES
(1, 2, 5, '2026-01-01', '16:27:00', 'pending', NULL, '2025-12-23 04:27:35', '2025-12-23 04:27:35'),
(2, 2, 3, '2025-12-27', '16:28:00', 'pending', NULL, '2025-12-23 04:28:48', '2025-12-23 04:28:48');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `specialty_id` bigint(20) UNSIGNED NOT NULL,
  `license_number` varchar(255) NOT NULL,
  `experience_years` int(11) NOT NULL DEFAULT 0,
  `bio` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `education` text DEFAULT NULL,
  `hospital_clinic_name` varchar(255) DEFAULT NULL,
  `working_hours` varchar(255) DEFAULT NULL,
  `languages` varchar(255) DEFAULT NULL,
  `certifications` text DEFAULT NULL,
  `consultation_fee` decimal(10,2) NOT NULL DEFAULT 0.00,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `user_id`, `specialty_id`, `license_number`, `experience_years`, `bio`, `image`, `phone`, `address`, `education`, `hospital_clinic_name`, `working_hours`, `languages`, `certifications`, `consultation_fee`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 7, 'abc123', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 900.00, 'active', '2025-12-23 02:48:15', '2025-12-23 02:48:15'),
(2, 4, 1, 'LIC-CARD-2020-001', 15, 'Dr. Sarah Johnson is a board-certified cardiologist with over 15 years of experience in treating heart conditions. She specializes in preventive cardiology and interventional procedures.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 250.00, 'active', '2025-12-23 04:10:58', '2025-12-23 04:10:58'),
(3, 5, 2, 'LIC-DERM-2018-002', 12, 'Dr. Michael Chen is an experienced dermatologist specializing in skin cancer treatment, cosmetic dermatology, and pediatric dermatology.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 200.00, 'active', '2025-12-23 04:10:58', '2025-12-23 04:10:58'),
(4, 6, 5, 'LIC-PED-2021-003', 8, 'Dr. Emily Rodriguez is a dedicated pediatrician with a passion for children\'s health. She provides comprehensive care for infants, children, and adolescents.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 150.00, 'active', '2025-12-23 04:10:58', '2025-12-23 04:10:58'),
(5, 7, 4, 'LIC-ORTH-2015-004', 20, 'Dr. James Wilson is a renowned orthopedic surgeon specializing in joint replacement, sports medicine, and trauma surgery.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 300.00, 'active', '2025-12-23 04:10:58', '2025-12-23 04:10:58'),
(6, 8, 3, 'LIC-NEUR-2019-005', 10, 'Dr. Lisa Anderson is a neurologist specializing in the diagnosis and treatment of neurological disorders, including epilepsy, stroke, and movement disorders.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 275.00, 'active', '2025-12-23 04:10:58', '2025-12-23 04:10:58'),
(7, 9, 7, 'LIC-GEN-2017-006', 14, 'Dr. Robert Taylor is a family medicine physician providing comprehensive primary care for patients of all ages, focusing on preventive medicine and chronic disease management.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 180.00, 'active', '2025-12-23 04:10:58', '2025-12-23 04:10:58'),
(8, 10, 6, 'LIC-PSYCH-2020-007', 9, 'Dr. Maria Garcia is a board-certified psychiatrist specializing in mood disorders, anxiety, and psychotherapy. She provides compassionate mental health care.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 220.00, 'active', '2025-12-23 04:10:58', '2025-12-23 04:10:58'),
(9, 11, 8, 'LIC-GYN-2018-008', 11, 'Dr. David Brown is an experienced gynecologist providing comprehensive women\'s health care, including routine exams, reproductive health, and gynecological surgery.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 240.00, 'active', '2025-12-23 04:10:58', '2025-12-23 04:10:58'),
(10, 12, 11, 'LIC-1162-6877-6278', 3, 'Amet quam dolor voluptas. Quo beatae tenetur autem. Occaecati nulla iste labore. Ea perspiciatis reiciendis dignissimos expedita ab architecto vitae.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 161.82, 'active', '2025-12-23 04:11:00', '2025-12-23 04:11:00'),
(11, 13, 8, 'LIC-8643-0315-3590', 18, 'Velit accusantium eum aut rerum qui distinctio repudiandae. Eligendi dolorem qui voluptas corrupti vitae deleniti. Omnis non explicabo aut consequuntur ex dolorum. Dolor adipisci facere eaque rem est sed. Voluptatibus culpa qui quibusdam eum reprehenderit cumque voluptatum.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 155.07, 'active', '2025-12-23 04:11:00', '2025-12-23 04:11:00'),
(12, 14, 12, 'LIC-2058-0616-2865', 20, 'Dolores culpa accusamus omnis magni sit voluptas ut. Ducimus cumque sed excepturi ut. Quisquam officia itaque velit enim fugit magni non deleniti. Quo quis in quo accusantium itaque voluptates molestiae.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 282.91, 'active', '2025-12-23 04:11:00', '2025-12-23 04:11:00'),
(13, 15, 13, 'LIC-3088-5524-8452', 9, 'Consectetur perferendis voluptatem similique velit atque fuga. Aliquid dolor omnis aut harum. Quae quam corrupti iure enim quas maiores. Qui dolor distinctio fugit autem eveniet repellendus.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 169.24, 'active', '2025-12-23 04:11:00', '2025-12-23 04:11:00'),
(14, 16, 15, 'LIC-1110-9418-9244', 16, 'Ea voluptas sit rerum. Distinctio magnam alias numquam ullam ut fugit voluptas. Sunt nobis commodi ea dolore facilis.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 404.65, 'active', '2025-12-23 04:11:00', '2025-12-23 04:11:00'),
(15, 17, 4, 'LIC-9781-3664-3364', 16, 'Amet assumenda repudiandae doloribus nihil. Quos ipsum quaerat officia maxime eum. Molestiae repellendus eos repudiandae id inventore. Eaque pariatur hic cumque non suscipit minima provident.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 425.57, 'active', '2025-12-23 04:11:00', '2025-12-23 04:11:00'),
(16, 18, 4, 'LIC-3777-8113-6038', 9, 'Sequi architecto mollitia fugiat consequatur sunt animi. Animi recusandae error amet et cumque non ipsum. Quis voluptatum est sapiente repellat cupiditate rerum dolorem.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 394.16, 'active', '2025-12-23 04:11:00', '2025-12-23 04:11:00'),
(17, 19, 4, 'LIC-2457-7579-3255', 18, 'Quia nulla nihil qui tempore a. Esse enim consequatur quo blanditiis assumenda.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 499.91, 'active', '2025-12-23 04:11:00', '2025-12-23 04:11:00'),
(18, 20, 8, 'LIC-6508-6784-9665', 28, 'Itaque voluptatem accusantium quod blanditiis repellat sed. Illum numquam autem exercitationem asperiores reprehenderit. In officia dolorem minus exercitationem enim. Numquam adipisci beatae iure quo.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 375.41, 'active', '2025-12-23 04:11:00', '2025-12-23 04:11:00'),
(19, 21, 1, 'LIC-8823-4179-9828', 4, 'Ratione neque aliquid suscipit ducimus et cum eius. Sit voluptas unde at voluptatum aut eveniet accusantium. Pariatur neque et mollitia et aut laboriosam deserunt quis.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 312.81, 'active', '2025-12-23 04:11:00', '2025-12-23 04:11:00');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_12_22_164651_create_specialties_table', 1),
(5, '2025_12_22_164726_create_doctors_table', 1),
(6, '2025_12_22_164744_create_appointments_table', 1),
(7, '2025_12_23_103448_create_posts_table', 2),
(8, '2025_12_23_110505_add_additional_fields_to_doctors_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `doctor_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('published','draft') NOT NULL DEFAULT 'published',
  `views` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `doctor_id`, `title`, `slug`, `description`, `image`, `status`, `views`, `created_at`, `updated_at`) VALUES
(1, 2, '10 Essential Heart Health Tips for a Healthy Lifestyle', '10-essential-heart-health-tips-for-a-healthy-lifestyle-1766486887-4913', 'Maintaining a healthy heart is crucial for overall well-being. Here are 10 essential tips to keep your heart in top condition: 1. Exercise regularly - aim for at least 30 minutes of moderate exercise daily. 2. Eat a balanced diet rich in fruits, vegetables, and whole grains. 3. Maintain a healthy weight. 4. Quit smoking and avoid secondhand smoke. 5. Limit alcohol consumption. 6. Manage stress through relaxation techniques. 7. Get enough sleep - 7-9 hours per night. 8. Monitor your blood pressure regularly. 9. Control cholesterol levels. 10. Stay hydrated and drink plenty of water. Remember, small changes can make a big difference in your heart health!', 'https://images.unsplash.com/photo-1559757148-5c350d0d3c56?w=800', 'published', 97, '2025-12-23 04:48:07', '2025-12-23 04:48:07'),
(2, 3, 'Understanding Skin Care: A Complete Guide to Healthy Skin', 'understanding-skin-care-a-complete-guide-to-healthy-skin-1766486887-6343', 'Your skin is your body\'s largest organ and requires proper care to stay healthy. Here\'s what you need to know: Daily cleansing is essential, but avoid over-washing which can strip natural oils. Use sunscreen with SPF 30 or higher every day, even on cloudy days. Moisturize regularly to maintain skin barrier function. Stay hydrated by drinking plenty of water. Eat a diet rich in antioxidants from fruits and vegetables. Avoid excessive sun exposure and tanning beds. Get adequate sleep as it helps skin repair and regenerate. Manage stress as it can trigger skin conditions. Consult a dermatologist for persistent skin issues. Remember, healthy skin starts from within!', 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1f?w=800', 'published', 241, '2025-12-23 04:48:07', '2025-12-23 05:17:28'),
(3, 4, 'Childhood Vaccination: Why It Matters for Your Child\'s Health', 'childhood-vaccination-why-it-matters-for-your-childs-health-1766486887-3356', 'Vaccinations are one of the most important ways to protect your child from serious diseases. Vaccines work by training the immune system to recognize and fight specific diseases. They have been proven safe and effective through extensive research. Following the recommended vaccination schedule protects not only your child but also the community through herd immunity. Common vaccines include those for measles, mumps, rubella, polio, and more. Talk to your pediatrician about any concerns you may have. Keep track of your child\'s vaccination records. Stay informed about vaccine-preventable diseases. Remember, prevention is always better than treatment!', 'https://images.unsplash.com/photo-1551601651-2a8555f1a136?w=800', 'published', 382, '2025-12-23 04:48:07', '2025-12-23 04:48:07'),
(4, 5, 'Preventing Sports Injuries: Tips for Athletes of All Levels', 'preventing-sports-injuries-tips-for-athletes-of-all-levels-1766486887-8627', 'Whether you\'re a professional athlete or a weekend warrior, preventing injuries is key to staying active. Always warm up before exercise with dynamic stretching. Cool down after workouts with static stretches. Use proper equipment and ensure it fits correctly. Gradually increase training intensity to avoid overuse injuries. Listen to your body and rest when needed. Stay hydrated before, during, and after exercise. Maintain good nutrition to support muscle recovery. Cross-train to prevent overuse of specific muscle groups. Get adequate sleep for recovery. Consult a sports medicine specialist for persistent pain. Remember, an injury prevented is better than an injury treated!', 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=800', 'published', 305, '2025-12-23 04:48:07', '2025-12-23 04:48:07'),
(5, 6, 'Brain Health: Simple Ways to Keep Your Mind Sharp', 'brain-health-simple-ways-to-keep-your-mind-sharp-1766486887-8539', 'Maintaining brain health is essential for cognitive function as we age. Engage in regular physical exercise which increases blood flow to the brain. Challenge your mind with puzzles, reading, and learning new skills. Get 7-9 hours of quality sleep each night. Eat a brain-healthy diet rich in omega-3 fatty acids, antioxidants, and vitamins. Stay socially active and maintain meaningful relationships. Manage stress through meditation, yoga, or other relaxation techniques. Avoid smoking and limit alcohol consumption. Protect your head from injuries. Stay mentally active with hobbies and interests. Regular check-ups can help detect issues early. Your brain health matters at every age!', 'https://images.unsplash.com/photo-1559757175-0eb30cd8c063?w=800', 'published', 234, '2025-12-23 04:48:07', '2025-12-23 04:48:07'),
(6, 7, 'Preventive Care: The Foundation of Good Health', 'preventive-care-the-foundation-of-good-health-1766486887-4125', 'Preventive care is the cornerstone of maintaining good health throughout your life. Schedule regular check-ups with your primary care physician. Get recommended screenings based on your age and risk factors. Maintain a healthy weight through diet and exercise. Don\'t skip vaccinations - they prevent serious illnesses. Practice good hygiene to prevent infections. Manage chronic conditions like diabetes and hypertension. Stay up to date with health information and recommendations. Build a relationship with a trusted healthcare provider. Keep track of your family medical history. Remember, investing in prevention saves time, money, and most importantly, your health!', 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=800', 'published', 413, '2025-12-23 04:48:07', '2025-12-23 04:52:45'),
(7, 8, 'Mental Health Awareness: Breaking the Stigma', 'mental-health-awareness-breaking-the-stigma-1766486887-5965', 'Mental health is just as important as physical health, yet it\'s often overlooked. Mental health conditions are common and treatable. Seeking help is a sign of strength, not weakness. Therapy and counseling can be highly effective. Medication, when prescribed, can help manage symptoms. Self-care practices like exercise and meditation support mental well-being. Building strong social connections is vital. Don\'t hesitate to reach out to mental health professionals. Support from family and friends makes a difference. Remember, you are not alone in your struggles. Taking care of your mental health is essential for overall wellness!', 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=800', 'published', 122, '2025-12-23 04:48:07', '2025-12-23 04:48:07'),
(8, 9, 'Women\'s Health: Important Screenings and Check-ups', 'womens-health-important-screenings-and-check-ups-1766486887-3437', 'Regular health screenings are crucial for women\'s well-being at every stage of life. Annual gynecological exams are recommended starting at age 21. Mammograms should begin at age 40 or earlier if there\'s a family history. Pap smears help detect cervical cancer early. Bone density scans are important after menopause. Regular blood pressure and cholesterol checks are essential. Don\'t skip annual physical exams. Discuss family planning and reproductive health with your doctor. Stay informed about breast and ovarian cancer risks. Maintain a healthy lifestyle with diet and exercise. Remember, early detection saves lives!', 'https://images.unsplash.com/photo-1551836022-d5d88e9218df?w=800', 'published', 456, '2025-12-23 04:48:07', '2025-12-23 04:48:07'),
(9, 11, 'Consequuntur qui totam sint aut quis labore necessitatibus rerum.', 'consequuntur-qui-totam-sint-aut-quis-labore-necessitatibus-rerum-1766486887-6013', 'Est labore inventore occaecati natus in. Et reprehenderit consequatur nihil facilis. Expedita voluptatem pariatur tempora sed. Et doloribus eaque eum deleniti quibusdam in.\n\nMagni aut consequatur commodi commodi. Vero nulla perspiciatis consequatur qui. Aut dolor et dolorem sed enim id omnis. Culpa ab ex itaque illum voluptates.\n\nAut mollitia culpa vel quaerat est. Amet ut consequatur odit magni ratione magnam sit. Quisquam enim ea asperiores sed rerum voluptatem nam.\n\nUt similique accusamus fugit ut. Quo ducimus ut quia voluptas sed deleniti. Et sit repudiandae eos placeat et nisi. Voluptas ut et nihil ipsum. Voluptatem id aspernatur aspernatur voluptatem aut in mollitia.', 'https://images.unsplash.com/photo-1527025064550?w=800', 'published', 578, '2025-12-23 04:48:07', '2025-12-23 04:48:07'),
(10, 2, 'Aut ut suscipit eius quibusdam.', 'aut-ut-suscipit-eius-quibusdam-1766486887-4503', 'Est velit sapiente voluptas eos dolorem minus vel iusto. Dolore rerum doloremque labore eum quia fugiat qui. Et ut ad ut dolores. Possimus quos eos culpa eligendi veniam nisi.\n\nEligendi neque quis soluta officiis reiciendis ut. Assumenda dignissimos aut atque in in totam. Fugit quia excepturi dicta et reiciendis aut. Laudantium numquam qui excepturi vero libero consequatur magni.\n\nSimilique sequi qui quae delectus aperiam est possimus. Saepe animi enim ut sunt numquam illum. Eius voluptas ipsa vitae.\n\nAmet eius aut qui. Ut quis laudantium alias aut officia rerum laborum. Nisi fuga eos reiciendis eum. Ut quas ea ut non temporibus possimus.', 'https://images.unsplash.com/photo-1518496140709?w=800', 'published', 171, '2025-12-23 04:48:07', '2025-12-23 04:48:07'),
(11, 16, 'Deleniti eos perferendis sit ut et.', 'deleniti-eos-perferendis-sit-ut-et-1766486887-5838', 'Ut explicabo et facilis quis et. Molestiae veniam molestiae ab sequi. Aut deserunt dolorem dignissimos. Magni omnis tenetur perferendis tempore praesentium fuga autem.\n\nConsequatur ipsa alias at natus quia veritatis. Occaecati suscipit accusamus voluptas ducimus labore dignissimos. Nulla cumque saepe et odio aut.\n\nVoluptatem omnis ipsam blanditiis repellat illum doloremque magni. Et voluptatibus quibusdam minima maiores aut. Eveniet ullam dolores nisi nulla sed deserunt provident.\n\nAspernatur et sunt reiciendis incidunt quaerat nostrum illum. Officia animi voluptatem illum cum est at nihil doloribus. Non et rerum est odit dolore sapiente.', 'https://images.unsplash.com/photo-1537283128499?w=800', 'published', 833, '2025-12-23 04:48:07', '2025-12-23 04:48:07'),
(12, 4, 'Beatae ipsa recusandae qui doloremque et ut in nisi.', 'beatae-ipsa-recusandae-qui-doloremque-et-ut-in-nisi-1766486887-1995', 'Eos libero expedita eveniet voluptas. Ut eum consequatur culpa iure tempore quos.\n\nIllo et dolor architecto in. Provident quia illo ullam. Alias nam cumque rerum vel. Provident voluptas deleniti nisi in sed.\n\nA eaque voluptatem quasi exercitationem. Placeat minus necessitatibus aspernatur quam. Corrupti suscipit ipsa totam consequuntur. Impedit distinctio est quidem. Sed rerum quae qui minima quisquam qui.\n\nCumque aut animi aliquid impedit quos. Suscipit reprehenderit sint qui dolorem ex nostrum. Vero inventore accusamus tenetur sint nesciunt.', 'https://images.unsplash.com/photo-1566518428087?w=800', 'published', 363, '2025-12-23 04:48:07', '2025-12-23 04:48:07'),
(13, 15, 'Officiis dolorem sed enim ut dolorum consectetur.', 'officiis-dolorem-sed-enim-ut-dolorum-consectetur-1766486887-5091', 'Consequatur sit ea veritatis ratione eveniet sunt. Debitis vero et minus corporis doloribus. Atque voluptatibus recusandae in voluptatem.\n\nVoluptatem vitae qui explicabo est id quasi omnis accusantium. Molestiae quasi aut corrupti maxime tempora explicabo. Dolor iste quod eius eveniet. Earum incidunt reprehenderit sed qui repudiandae non.\n\nAut voluptatum magni deleniti nobis ut praesentium aut. Libero ex id non nam suscipit. Illo doloremque est quia voluptatibus. Sed debitis fugiat impedit illum iste voluptatem.\n\nDoloremque dolore quis aut eaque. Nostrum id rerum quod vitae enim ex. Adipisci rerum dolorem eveniet. Et quidem quaerat et.', 'https://images.unsplash.com/photo-1510588736732?w=800', 'published', 553, '2025-12-23 04:48:07', '2025-12-23 04:48:07'),
(14, 13, 'Omnis deleniti et hic minima placeat.', 'omnis-deleniti-et-hic-minima-placeat-1766486887-2816', 'Similique enim quia nihil ducimus eligendi. Autem occaecati voluptas aut. Cupiditate sint minima molestias illum tempore est rerum. Quae nisi odit fuga ut voluptatem eum.\n\nDistinctio vero tenetur cumque dolores nihil rem velit. Beatae impedit sed dolorem facilis incidunt asperiores.\n\nQuos suscipit architecto aut sed sequi nam consectetur qui. Tenetur vero sed cumque et est. Placeat et incidunt soluta dolores eum. Ratione assumenda quod deserunt.\n\nSed qui mollitia aut exercitationem error doloremque eum. Laudantium quia delectus natus eum ullam non nihil. Facere ducimus et tenetur qui et et in.', 'https://images.unsplash.com/photo-1519726391045?w=800', 'published', 90, '2025-12-23 04:48:07', '2025-12-23 04:48:07'),
(15, 13, 'Blanditiis temporibus excepturi molestiae.', 'blanditiis-temporibus-excepturi-molestiae-1766486887-6034', 'Et veniam deleniti voluptatem eaque. Porro voluptates autem rem laudantium fugiat animi. Libero quia reiciendis ut at sed amet ratione et.\n\nCupiditate sed cupiditate sed similique. Non cum illum qui repellendus voluptas ipsa ratione.\n\nUt distinctio nam omnis. Et qui consequuntur minus vel repellat et. Et est iusto consequuntur fugit. Dolorem facere quibusdam perferendis commodi omnis fuga ut.\n\nVitae enim accusantium provident maxime dolore assumenda. Neque eligendi ipsa tempore enim adipisci repellat molestiae eius. In nemo blanditiis officia reiciendis. Sit officia qui reprehenderit illum aliquid facere.', 'https://images.unsplash.com/photo-1513588910161?w=800', 'published', 727, '2025-12-23 04:48:07', '2025-12-23 04:48:07'),
(16, 7, 'Tenetur qui inventore laudantium in vel omnis sequi quo.', 'tenetur-qui-inventore-laudantium-in-vel-omnis-sequi-quo-1766486887-7861', 'Adipisci asperiores voluptate sunt mollitia soluta. Vel occaecati totam aperiam voluptatem quisquam velit.\n\nEt magni ea molestiae aperiam dolores qui optio. Odio ipsum itaque ducimus repellat et eos. Necessitatibus blanditiis cumque reprehenderit fugit officia.\n\nEum ut error vel iste consequatur eos eos mollitia. Quod eius minus quia aut cum fugiat placeat. Quia officia est id atque eveniet. Natus adipisci velit dignissimos repellendus quia.\n\nEst fugit eaque ea possimus ipsa est itaque sapiente. Suscipit doloremque similique sunt tenetur quaerat et veniam.', 'https://images.unsplash.com/photo-1527236008507?w=800', 'published', 653, '2025-12-23 04:48:07', '2025-12-23 04:48:07'),
(17, 3, 'Dolor consequuntur aut labore est consequuntur id.', 'dolor-consequuntur-aut-labore-est-consequuntur-id-1766486887-4271', 'Nam aspernatur in ipsa sequi minima. Vel amet et incidunt sit esse quod inventore expedita. Modi modi perspiciatis facere nisi soluta. Earum sequi voluptas nihil.\n\nMaxime est perspiciatis ducimus voluptatem. Qui qui et qui id quas sapiente nihil enim. Veritatis corporis qui eos natus exercitationem totam. Rerum quas enim eveniet blanditiis accusamus.\n\nRecusandae nesciunt laudantium nostrum est sunt vitae. Tempore voluptas porro et voluptas in debitis aut corporis. Quia ad ut autem voluptate ex ipsum omnis. Aliquam fuga ea autem sunt voluptas.\n\nBlanditiis deleniti repudiandae recusandae velit nihil recusandae quo. Dolor enim quam rem in. Eum aut est praesentium adipisci quisquam ut ad.', 'https://images.unsplash.com/photo-1528269210203?w=800', 'published', 192, '2025-12-23 04:48:07', '2025-12-23 04:48:07'),
(18, 17, 'Pariatur corrupti et eum eligendi placeat minima sequi.', 'pariatur-corrupti-et-eum-eligendi-placeat-minima-sequi-1766486887-3654', 'Eius occaecati rerum possimus sit sed corrupti est. Tenetur molestias magnam labore et expedita nostrum.\n\nMaiores animi fuga fugit voluptatem. Debitis eum fugiat dolore voluptatum beatae optio rerum. Eveniet et porro sint aliquam beatae corporis excepturi.\n\nMolestiae aut unde nostrum non illo dolores consequatur. Adipisci omnis commodi eaque sunt. Voluptas pariatur unde fugit deserunt recusandae ut. Laboriosam sit magnam corporis non magnam qui tenetur.\n\nA ut corporis quaerat sit minus. Explicabo id nesciunt odit vitae nisi. Sed placeat molestiae voluptas optio. Quisquam rerum explicabo sapiente doloremque ipsa.', 'https://images.unsplash.com/photo-1521580714497?w=800', 'published', 881, '2025-12-23 04:48:07', '2025-12-23 04:48:07'),
(19, 1, 'Qui quia et ex ratio', 'qui-quia-et-ex-ratio-1766488678', 'Sunt mollit ut digni', NULL, 'published', 0, '2025-12-23 05:17:58', '2025-12-23 05:17:58'),
(20, 1, 'Illum voluptatum an', 'illum-voluptatum-an-1766488697', 'Explicabo Veniam i', 'posts/JMSLndEzWSryRUHrXvCS9Dm5I0QpxOmWKewoCZKX.jpg', 'draft', 0, '2025-12-23 05:18:17', '2025-12-23 05:18:17');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('JDXgjcOtrOW7fQOk0ig0lfGoBgQTbPKujA68CBZG', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoib2ZFQzduV0JpZ0pyUTdRdWJLc01ZSGVENVljN2JEY3RFY0dPY3VRSSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7Tjt9fQ==', 1766489415);

-- --------------------------------------------------------

--
-- Table structure for table `specialties`
--

CREATE TABLE `specialties` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `specialties`
--

INSERT INTO `specialties` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Cardiology', 'Heart and cardiovascular system', '2025-12-22 11:36:22', '2025-12-22 11:36:22'),
(2, 'Dermatology', 'Skin, hair, and nails', '2025-12-22 11:36:22', '2025-12-22 11:36:22'),
(3, 'Neurology', 'Brain and nervous system', '2025-12-22 11:36:22', '2025-12-22 11:36:22'),
(4, 'Orthopedics', 'Bones, joints, and muscles', '2025-12-22 11:36:22', '2025-12-22 11:36:22'),
(5, 'Pediatrics', 'Children and adolescents', '2025-12-22 11:36:22', '2025-12-22 11:36:22'),
(6, 'Psychiatry', 'Mental health and disorders', '2025-12-22 11:36:22', '2025-12-22 11:36:22'),
(7, 'General Medicine', 'General health and wellness', '2025-12-22 11:36:22', '2025-12-22 11:36:22'),
(8, 'Gynecology', 'Women\'s reproductive health', '2025-12-22 11:36:22', '2025-12-22 11:36:22'),
(9, 'Test', NULL, '2025-12-23 02:47:36', '2025-12-23 02:47:36'),
(10, 'Cardiology', 'Heart and cardiovascular system', '2025-12-23 04:10:52', '2025-12-23 04:10:52'),
(11, 'Dermatology', 'Skin, hair, and nails', '2025-12-23 04:10:52', '2025-12-23 04:10:52'),
(12, 'Neurology', 'Brain and nervous system', '2025-12-23 04:10:52', '2025-12-23 04:10:52'),
(13, 'Orthopedics', 'Bones, joints, and muscles', '2025-12-23 04:10:52', '2025-12-23 04:10:52'),
(14, 'Pediatrics', 'Children and adolescents', '2025-12-23 04:10:52', '2025-12-23 04:10:52'),
(15, 'Psychiatry', 'Mental health and disorders', '2025-12-23 04:10:52', '2025-12-23 04:10:52'),
(16, 'General Medicine', 'General health and wellness', '2025-12-23 04:10:52', '2025-12-23 04:10:52'),
(17, 'Gynecology', 'Women\'s reproductive health', '2025-12-23 04:10:52', '2025-12-23 04:10:52');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Admin','Patient','Doctor') NOT NULL DEFAULT 'Patient',
  `phone` varchar(255) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `address` text DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `phone`, `date_of_birth`, `address`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin User', 'admin@dms.com', NULL, '$2y$12$I2WcCPw03jqN8vUOKY2VRe2jG9KUPDkcbj5koKz4M8OTmGCeMK3Du', 'Admin', NULL, NULL, NULL, NULL, '2025-12-22 11:36:22', '2025-12-22 11:36:22'),
(2, 'Patient', 'patient@gmail.com', NULL, '$2y$12$.RdUrT/fd5Fu5LxAugHPROX2PELZgscQpKVmJPq2xDqdekUjTZxta', 'Patient', '01632109022', '2000-01-01', 'BD', NULL, '2025-12-22 12:16:14', '2025-12-22 12:16:14'),
(3, 'Doctor', 'doctor@gmail.com', NULL, '$2y$12$RXDim7SMJmzZ4hX1Hqsmpedq1/qkneaq1Ahs4yC3VkohoGNuTqu4G', 'Doctor', NULL, NULL, NULL, NULL, '2025-12-23 02:46:48', '2025-12-23 02:46:48'),
(4, 'Dr. Sarah Johnson', 'sarah.johnson@dms.com', NULL, '$2y$12$g.w.NNFWAg4Lg195chzYVu/utnZILOL7bf7liLefiCqvz1dRsKwm.', 'Doctor', '+1-555-0101', '1980-05-15', '123 Medical Center Dr, Health City, HC 12345', NULL, '2025-12-23 04:10:58', '2025-12-23 04:10:58'),
(5, 'Dr. Michael Chen', 'michael.chen@dms.com', NULL, '$2y$12$DEz8HwwSPCPzthtCjOOh3.FZ/bCXawfcVdVpBp9ad7io0RwchmUTu', 'Doctor', '+1-555-0102', '1978-08-22', '456 Health Avenue, Medical District, MD 54321', NULL, '2025-12-23 04:10:58', '2025-12-23 04:10:58'),
(6, 'Dr. Emily Rodriguez', 'emily.rodriguez@dms.com', NULL, '$2y$12$UKWTecYnLul0y/uGfvhGqOg8xfPZ1SNDapDrdMg7URPXqgAH40c2.', 'Doctor', '+1-555-0103', '1985-03-10', '789 Wellness Blvd, Care City, CC 67890', NULL, '2025-12-23 04:10:58', '2025-12-23 04:10:58'),
(7, 'Dr. James Wilson', 'james.wilson@dms.com', NULL, '$2y$12$a2K0YyQRjXz454t/JLVFqeaMO2Rg2KGyPiwYHmUVeCZKm.WsL.LxS', 'Doctor', '+1-555-0104', '1975-11-30', '321 Medical Plaza, Health Town, HT 11223', NULL, '2025-12-23 04:10:58', '2025-12-23 04:10:58'),
(8, 'Dr. Lisa Anderson', 'lisa.anderson@dms.com', NULL, '$2y$12$53yvZheCuVH6XIDLYEo1FOcx8hcy8A32Ak2G/rv3zYzyRKNNXqWUG', 'Doctor', '+1-555-0105', '1982-07-18', '654 Care Street, Wellness City, WC 44556', NULL, '2025-12-23 04:10:58', '2025-12-23 04:10:58'),
(9, 'Dr. Robert Taylor', 'robert.taylor@dms.com', NULL, '$2y$12$R.WHP96b.cXb1ihoOu0ZeO68xlLGuetcbP97y8Kzth8ZuWC1OjSq6', 'Doctor', '+1-555-0106', '1979-12-05', '987 Health Drive, Medical Center, MC 77889', NULL, '2025-12-23 04:10:58', '2025-12-23 04:10:58'),
(10, 'Dr. Maria Garcia', 'maria.garcia@dms.com', NULL, '$2y$12$RlrHI.qb0cGkG7RLvkizhOoWF9xxa6ETdKLVsuNHiHjrSwZKlKTE2', 'Doctor', '+1-555-0107', '1983-04-25', '147 Wellness Way, Care District, CD 33445', NULL, '2025-12-23 04:10:58', '2025-12-23 04:10:58'),
(11, 'Dr. David Brown', 'david.brown@dms.com', NULL, '$2y$12$7nN2.9sHlo2BvBEw5qDUdOGqbQU1wb0r/mcLUvLCjACv/IVADi98W', 'Doctor', '+1-555-0108', '1981-09-14', '258 Medical Lane, Health Village, HV 55667', NULL, '2025-12-23 04:10:58', '2025-12-23 04:10:58'),
(12, 'Brennan Schmeler', 'considine.emmanuelle@example.org', '2025-12-23 04:10:58', '$2y$12$k/Oz61f3chp6XwjVZGJF..XaihTnY9JMkPJtJ.R5i3ff76Bql3oG6', 'Doctor', '+1-520-752-9174', '1991-03-17', '1128 Vidal Center Apt. 830\nO\'Connerbury, AL 22112-4546', 'DaWwZrN5gX', '2025-12-23 04:10:59', '2025-12-23 04:10:59'),
(13, 'Murray Casper', 'blanda.bettye@example.com', '2025-12-23 04:10:59', '$2y$12$k/Oz61f3chp6XwjVZGJF..XaihTnY9JMkPJtJ.R5i3ff76Bql3oG6', 'Doctor', '1-925-338-4791', '1996-09-26', '524 Turcotte Tunnel Suite 328\nGianniberg, DE 79997-1597', 'VJW81KEhDM', '2025-12-23 04:10:59', '2025-12-23 04:10:59'),
(14, 'Onie Hagenes', 'virgie72@example.com', '2025-12-23 04:11:00', '$2y$12$k/Oz61f3chp6XwjVZGJF..XaihTnY9JMkPJtJ.R5i3ff76Bql3oG6', 'Doctor', '743.523.5723', '1974-08-08', '51751 Heller Courts\nKuhnfort, HI 34073-5672', 'alNeQrQQ30', '2025-12-23 04:11:00', '2025-12-23 04:11:00'),
(15, 'Nathaniel Blanda', 'claudia.christiansen@example.org', '2025-12-23 04:11:00', '$2y$12$k/Oz61f3chp6XwjVZGJF..XaihTnY9JMkPJtJ.R5i3ff76Bql3oG6', 'Doctor', '+1.870.509.9601', '1976-08-26', '7430 Geovanni Motorway Suite 453\nDennisberg, HI 50182', 'bDVHNHR8Fu', '2025-12-23 04:11:00', '2025-12-23 04:11:00'),
(16, 'Randal Collins', 'tshields@example.net', '2025-12-23 04:11:00', '$2y$12$k/Oz61f3chp6XwjVZGJF..XaihTnY9JMkPJtJ.R5i3ff76Bql3oG6', 'Doctor', '1-763-437-9265', '2000-05-23', '8379 Noble Canyon\nNorth Vito, VA 71905-2211', 'MDQqmZDJ62', '2025-12-23 04:11:00', '2025-12-23 04:11:00'),
(17, 'Alaina Murray', 'hyatt.mateo@example.net', '2025-12-23 04:11:00', '$2y$12$k/Oz61f3chp6XwjVZGJF..XaihTnY9JMkPJtJ.R5i3ff76Bql3oG6', 'Doctor', '+1-272-747-7237', '1992-05-03', '620 Casper Mountain Suite 993\nChristianaport, OH 28792-1813', 'b1PvtxUTpU', '2025-12-23 04:11:00', '2025-12-23 04:11:00'),
(18, 'Prof. Emmy Lehner V', 'jarret.swaniawski@example.com', '2025-12-23 04:11:00', '$2y$12$k/Oz61f3chp6XwjVZGJF..XaihTnY9JMkPJtJ.R5i3ff76Bql3oG6', 'Doctor', '423.936.3865', '1971-04-07', '114 Rice Knoll\nPort Alia, WI 20068', 'jLLZ56SM0Z', '2025-12-23 04:11:00', '2025-12-23 04:11:00'),
(19, 'Dr. Johan Windler', 'breichel@example.net', '2025-12-23 04:11:00', '$2y$12$k/Oz61f3chp6XwjVZGJF..XaihTnY9JMkPJtJ.R5i3ff76Bql3oG6', 'Doctor', '414-220-9506', '2004-06-29', '6157 Walter Road Suite 180\nHoegerburgh, NJ 93262', 'Jw3HUxdHBW', '2025-12-23 04:11:00', '2025-12-23 04:11:00'),
(20, 'Prof. Lilian Senger V', 'kgreenholt@example.org', '2025-12-23 04:11:00', '$2y$12$k/Oz61f3chp6XwjVZGJF..XaihTnY9JMkPJtJ.R5i3ff76Bql3oG6', 'Doctor', '1-743-780-3526', '1970-04-08', '69306 Abbott Manors\nSouth Brennan, GA 24959-9113', 'uLQnTvPpFA', '2025-12-23 04:11:00', '2025-12-23 04:11:00'),
(21, 'Percy Bednar', 'bergstrom.kenyon@example.net', '2025-12-23 04:11:00', '$2y$12$k/Oz61f3chp6XwjVZGJF..XaihTnY9JMkPJtJ.R5i3ff76Bql3oG6', 'Doctor', '+1-952-402-5371', '1989-03-01', '11617 Kemmer Flat Apt. 246\nEast Jaida, TX 01939', 'C2eO0B4Vxo', '2025-12-23 04:11:00', '2025-12-23 04:11:00'),
(23, 'Admin', 'admin@gmail.com', NULL, '$2y$12$lnHrK3tXTQa5t9XXSHyXMOZCvSZEIX4BVbTFxQOawesmeR0NlXlkO', 'Admin', NULL, NULL, NULL, NULL, '2025-12-23 05:20:12', '2025-12-23 05:20:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `appointments_patient_id_foreign` (`patient_id`),
  ADD KEY `appointments_doctor_id_foreign` (`doctor_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `doctors_license_number_unique` (`license_number`),
  ADD KEY `doctors_user_id_foreign` (`user_id`),
  ADD KEY `doctors_specialty_id_foreign` (`specialty_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `posts_slug_unique` (`slug`),
  ADD KEY `posts_doctor_id_foreign` (`doctor_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `specialties`
--
ALTER TABLE `specialties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `specialties`
--
ALTER TABLE `specialties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `appointments_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `doctors_specialty_id_foreign` FOREIGN KEY (`specialty_id`) REFERENCES `specialties` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `doctors_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
