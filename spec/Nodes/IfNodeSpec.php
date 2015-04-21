<?php

namespace spec\Slade\Nodes;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Slade\Scope;
use Slade\TemplateBlock;

class IfNodeSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Slade\Nodes\IfNode');
    }

    function it_returns_null_if_provided_with_a_falsy(Scope $scope)
    {
        $block = new TemplateBlock(
            '? messages' . PHP_EOL . ' | You have {{ messages }} messages!'
        );
        $scope->offsetGet('messages')->willReturn(0);

        $this
            ::parse($block, $scope, $scope)
            ->shouldBeNull();
    }

    function it_parses_insides_if_provided_with_a_truthy(Scope $scope)
    {
        $block = new TemplateBlock(
            '? messages' . PHP_EOL . ' | You have {{ messages }} messages!'
        );
        $scope->offsetGet('messages')->willReturn(3);

        $this
            ::parse($block, $scope, $scope)
            ->shouldBeLike('You have 3 messages!');
    }
}
