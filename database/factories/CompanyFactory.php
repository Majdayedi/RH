<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $companyName = $this->faker->company;
        $logoOptions = $this->generateLogoOptions($companyName);

        return [
            'legal_name' => $companyName,
            'trade_name' => $this->faker->companySuffix,
            'registration_number' => $this->faker->unique()->numerify('REG-#####'),
            'tax_id' => $this->faker->unique()->numerify('TAX-#####'),
            'incorporation_date' => $this->faker->date(),
            'legal_structure' => $this->faker->word,
            'jurisdiction' => $this->faker->country,
            'industry' => $this->faker->word,
            'is_active' => true,
            'headquarters_address' => $this->faker->address,
            'country' => $this->faker->countryCode,
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'website' => $this->faker->url,
            'certificate_of_incorporation' => $this->faker->fileExtension,
            'tax_registration_certificate' => $this->faker->fileExtension,
            'logo' => $this->faker->randomElement(['company/logos/barca.webp', 'company/logos/samsung.png', 'company/logos/telnet.png',"company/logos/asm.png","company/logos/microsoft.png"]),

        ];
    }

    /**
     * Generate various logo options for a company
     */
    private function generateLogoOptions(string $companyName): array
    {
        $initials = $this->getCompanyInitials($companyName);
        $colors = ['FF6B6B', '4ECDC4', '45B7D1', 'FFA07A', '98D8C8', 'F7DC6F', 'BB8FCE', '85C1E9'];
        $randomColor = $this->faker->randomElement($colors);
        $randomId = $this->faker->numberBetween(1, 1000);

        return [
            // UI Avatars with company initials
            "https://ui-avatars.com/api/?name={$initials}&background={$randomColor}&color=ffffff&size=200&font-size=0.6",

            // DiceBear avatars (company style)
            "https://api.dicebear.com/7.x/initials/svg?seed={$initials}&backgroundColor={$randomColor}",

            // Placeholder with company initials
            "https://via.placeholder.com/200x200/{$randomColor}/ffffff?text={$initials}",

            // Random abstract images (good for logos)
            "https://picsum.photos/200/200?random={$randomId}",

            // Logo.dev (if you want more realistic logos)
            "https://img.logo.dev/{$this->faker->domainName}?token=pk_X-1ZO13GSgeOoUrIuJ6GMQ&size=200",

            // Some companies might not have logos
            null,
        ];
    }

    /**
     * Extract initials from company name
     */
    private function getCompanyInitials(string $companyName): string
    {
        $words = explode(' ', $companyName);
        $initials = '';

        foreach (array_slice($words, 0, 2) as $word) {
            $initials .= strtoupper(substr($word, 0, 1));
        }

        return $initials ?: 'CO';
    }
}
