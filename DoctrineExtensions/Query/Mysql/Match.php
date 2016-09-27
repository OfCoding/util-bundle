<?php

namespace Kimerikal\UtilBundle\DoctrineExtensions\Query\Mysql;

use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\Lexer;

class Match extends FunctionNode {

    public $arithmeticExpression;

    public function getSql(\Doctrine\ORM\Query\SqlWalker $sqlWalker) {
        return 'MATCH(' . $sqlWalker->walkSimpleArithmeticExpression(
                        $this->arithmeticExpression
                ) . ')';
    }

    public function parse(\Doctrine\ORM\Query\Parser $parser) {
        $lexer = $parser->getLexer();
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);
        $this->arithmeticExpression = $parser->SimpleArithmeticExpression();
        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }

}
