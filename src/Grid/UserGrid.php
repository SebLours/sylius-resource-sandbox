<?php

declare(strict_types=1);

namespace App\Grid;

use App\Grid\Provider\UserGridDataProvider;
use App\Model\User;
use Sylius\Bundle\GridBundle\Builder\Action\ShowAction;
use Sylius\Bundle\GridBundle\Builder\ActionGroup\ItemActionGroup;
use Sylius\Bundle\GridBundle\Builder\Field\StringField;
use Sylius\Bundle\GridBundle\Builder\Field\TwigField;
use Sylius\Bundle\GridBundle\Builder\GridBuilderInterface;
use Sylius\Bundle\GridBundle\Grid\AbstractGrid;
use Sylius\Bundle\GridBundle\Grid\ResourceAwareGridInterface;

final class UserGrid extends AbstractGrid implements ResourceAwareGridInterface
{
    public function buildGrid(GridBuilderInterface $gridBuilder): void
    {
        $gridBuilder
            ->setProvider(UserGridDataProvider::class)
            ->setLimits([10])
            ->addField(
                TwigField::create('gender', 'grid/field/gender.html.twig')->setLabel('Gender')
            )
            ->addField(
                StringField::create('firstName')->setLabel('First name')
            )
            ->addField(
                StringField::create('lastName')->setLabel('Last name')
            )
            ->addField(
                StringField::create('bloodGroup')->setLabel('Blood group')
            )
            ->addActionGroup(
                ItemActionGroup::create(
                    ShowAction::create(),
                ),
            )
        ;
    }

    public function getResourceClass(): string
    {
        return User::class;
    }

    public static function getName(): string
    {
        return __CLASS__;
    }
}
