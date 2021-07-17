<?php

namespace App\Twig;

use App\Entity\Partners;
use App\Entity\PricingBlock;
use App\Entity\Testimonials;
use App\Services\HtmlHelper;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\Expr\Func;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    private $em, $htmlHelper;

    public function __construct(
        EntityManagerInterface $em,
        HtmlHelper $htmlHelper
    ) {
        $this->em = $em;
        $this->htmlHelper = $htmlHelper;
    }

    public function getFilters()
    {
        return [
            new TwigFilter('promoPrice', [$this, 'promoPrice']),
        ];
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('pricingBlock', [$this, 'getPricingBlock']),
            new TwigFunction('testimonialsBlock', [$this, 'getTestimonials']),
            new TwigFunction('getPartnersDetails', [$this, 'getPartners']),
            new TwigFunction('sectionify', [$this, 'sectionify'], ['is_safe' => ['html']]),
        ];
    }

    // Filters

    /**
     * @param $price
     *
     * @return string
     */
    public function promoPrice($price)
    {
        if (0 === (int)$price) {
            return 'FREE';
        }

        return '$ '.number_format($price, 2);
    }

    // Functions

    /**
     * @param $status
     *
     * @return mixed
     */
    public function getPricingBlock($status)
    {
        return $this->em->getRepository(PricingBlock::class)->getBlockPricingDetails($status);
    }

    /**
     * @return mixed
     */
    public function getTestimonials()
    {
        return $this->em->getRepository(Testimonials::class)->getTestimonials();
    }

    /**
     * @return mixed
     */
    public function getPartners()
    {
        return $this->em->getRepository(Partners::class)->getPartners();
    }

    public Function sectionify($heading, $text) 
    {
        return $this->htmlHelper->sectionTitle($heading, $text);
    }

}
