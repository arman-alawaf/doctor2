<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Doctor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Load doctors with users
        $doctors = Doctor::where('status', 'active')
            ->with('user')
            ->get();
        
        if ($doctors->isEmpty()) {
            $this->command->warn('No active doctors found. Please run DoctorSeeder first.');
            return;
        }

        // Demo posts with specific content
        $demoPosts = [
            [
                'doctor_id' => $doctors->firstWhere('user.name', 'Dr. Sarah Johnson')?->id ?? $doctors->random()->id,
                'title' => '10 Essential Heart Health Tips for a Healthy Lifestyle',
                'description' => 'Maintaining a healthy heart is crucial for overall well-being. Here are 10 essential tips to keep your heart in top condition: 1. Exercise regularly - aim for at least 30 minutes of moderate exercise daily. 2. Eat a balanced diet rich in fruits, vegetables, and whole grains. 3. Maintain a healthy weight. 4. Quit smoking and avoid secondhand smoke. 5. Limit alcohol consumption. 6. Manage stress through relaxation techniques. 7. Get enough sleep - 7-9 hours per night. 8. Monitor your blood pressure regularly. 9. Control cholesterol levels. 10. Stay hydrated and drink plenty of water. Remember, small changes can make a big difference in your heart health!',
                'image' => 'https://images.unsplash.com/photo-1559757148-5c350d0d3c56?w=800',
                'status' => 'published',
            ],
            [
                'doctor_id' => $doctors->firstWhere('user.name', 'Dr. Michael Chen')?->id ?? $doctors->random()->id,
                'title' => 'Understanding Skin Care: A Complete Guide to Healthy Skin',
                'description' => 'Your skin is your body\'s largest organ and requires proper care to stay healthy. Here\'s what you need to know: Daily cleansing is essential, but avoid over-washing which can strip natural oils. Use sunscreen with SPF 30 or higher every day, even on cloudy days. Moisturize regularly to maintain skin barrier function. Stay hydrated by drinking plenty of water. Eat a diet rich in antioxidants from fruits and vegetables. Avoid excessive sun exposure and tanning beds. Get adequate sleep as it helps skin repair and regenerate. Manage stress as it can trigger skin conditions. Consult a dermatologist for persistent skin issues. Remember, healthy skin starts from within!',
                'image' => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1f?w=800',
                'status' => 'published',
            ],
            [
                'doctor_id' => $doctors->firstWhere('user.name', 'Dr. Emily Rodriguez')?->id ?? $doctors->random()->id,
                'title' => 'Childhood Vaccination: Why It Matters for Your Child\'s Health',
                'description' => 'Vaccinations are one of the most important ways to protect your child from serious diseases. Vaccines work by training the immune system to recognize and fight specific diseases. They have been proven safe and effective through extensive research. Following the recommended vaccination schedule protects not only your child but also the community through herd immunity. Common vaccines include those for measles, mumps, rubella, polio, and more. Talk to your pediatrician about any concerns you may have. Keep track of your child\'s vaccination records. Stay informed about vaccine-preventable diseases. Remember, prevention is always better than treatment!',
                'image' => 'https://images.unsplash.com/photo-1551601651-2a8555f1a136?w=800',
                'status' => 'published',
            ],
            [
                'doctor_id' => $doctors->firstWhere('user.name', 'Dr. James Wilson')?->id ?? $doctors->random()->id,
                'title' => 'Preventing Sports Injuries: Tips for Athletes of All Levels',
                'description' => 'Whether you\'re a professional athlete or a weekend warrior, preventing injuries is key to staying active. Always warm up before exercise with dynamic stretching. Cool down after workouts with static stretches. Use proper equipment and ensure it fits correctly. Gradually increase training intensity to avoid overuse injuries. Listen to your body and rest when needed. Stay hydrated before, during, and after exercise. Maintain good nutrition to support muscle recovery. Cross-train to prevent overuse of specific muscle groups. Get adequate sleep for recovery. Consult a sports medicine specialist for persistent pain. Remember, an injury prevented is better than an injury treated!',
                'image' => 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=800',
                'status' => 'published',
            ],
            [
                'doctor_id' => $doctors->firstWhere('user.name', 'Dr. Lisa Anderson')?->id ?? $doctors->random()->id,
                'title' => 'Brain Health: Simple Ways to Keep Your Mind Sharp',
                'description' => 'Maintaining brain health is essential for cognitive function as we age. Engage in regular physical exercise which increases blood flow to the brain. Challenge your mind with puzzles, reading, and learning new skills. Get 7-9 hours of quality sleep each night. Eat a brain-healthy diet rich in omega-3 fatty acids, antioxidants, and vitamins. Stay socially active and maintain meaningful relationships. Manage stress through meditation, yoga, or other relaxation techniques. Avoid smoking and limit alcohol consumption. Protect your head from injuries. Stay mentally active with hobbies and interests. Regular check-ups can help detect issues early. Your brain health matters at every age!',
                'image' => 'https://images.unsplash.com/photo-1559757175-0eb30cd8c063?w=800',
                'status' => 'published',
            ],
            [
                'doctor_id' => $doctors->firstWhere('user.name', 'Dr. Robert Taylor')?->id ?? $doctors->random()->id,
                'title' => 'Preventive Care: The Foundation of Good Health',
                'description' => 'Preventive care is the cornerstone of maintaining good health throughout your life. Schedule regular check-ups with your primary care physician. Get recommended screenings based on your age and risk factors. Maintain a healthy weight through diet and exercise. Don\'t skip vaccinations - they prevent serious illnesses. Practice good hygiene to prevent infections. Manage chronic conditions like diabetes and hypertension. Stay up to date with health information and recommendations. Build a relationship with a trusted healthcare provider. Keep track of your family medical history. Remember, investing in prevention saves time, money, and most importantly, your health!',
                'image' => 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=800',
                'status' => 'published',
            ],
            [
                'doctor_id' => $doctors->firstWhere('user.name', 'Dr. Maria Garcia')?->id ?? $doctors->random()->id,
                'title' => 'Mental Health Awareness: Breaking the Stigma',
                'description' => 'Mental health is just as important as physical health, yet it\'s often overlooked. Mental health conditions are common and treatable. Seeking help is a sign of strength, not weakness. Therapy and counseling can be highly effective. Medication, when prescribed, can help manage symptoms. Self-care practices like exercise and meditation support mental well-being. Building strong social connections is vital. Don\'t hesitate to reach out to mental health professionals. Support from family and friends makes a difference. Remember, you are not alone in your struggles. Taking care of your mental health is essential for overall wellness!',
                'image' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=800',
                'status' => 'published',
            ],
            [
                'doctor_id' => $doctors->firstWhere('user.name', 'Dr. David Brown')?->id ?? $doctors->random()->id,
                'title' => 'Women\'s Health: Important Screenings and Check-ups',
                'description' => 'Regular health screenings are crucial for women\'s well-being at every stage of life. Annual gynecological exams are recommended starting at age 21. Mammograms should begin at age 40 or earlier if there\'s a family history. Pap smears help detect cervical cancer early. Bone density scans are important after menopause. Regular blood pressure and cholesterol checks are essential. Don\'t skip annual physical exams. Discuss family planning and reproductive health with your doctor. Stay informed about breast and ovarian cancer risks. Maintain a healthy lifestyle with diet and exercise. Remember, early detection saves lives!',
                'image' => 'https://images.unsplash.com/photo-1551836022-d5d88e9218df?w=800',
                'status' => 'published',
            ],
        ];

        // Create demo posts
        foreach ($demoPosts as $postData) {
            $postData['slug'] = Str::slug($postData['title']) . '-' . time() . '-' . fake()->unique()->numberBetween(1000, 9999);
            $postData['views'] = fake()->numberBetween(50, 500);
            Post::create($postData);
        }

        // Create additional random posts using factory
        Post::factory()
            ->count(10)
            ->published()
            ->create();

        $this->command->info('Demo posts created successfully!');
    }
}
