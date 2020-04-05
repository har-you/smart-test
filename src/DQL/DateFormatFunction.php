<?php

namespace App\DQL;

use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\Lexer;
use Doctrine\ORM\Query\Parser;
use Doctrine\ORM\Query\SqlWalker;

/**
 * Class DateFormatFunction
 */
class DateFormatFunction extends FunctionNode
{
    /**
     * Holds the timestamp of the DATE_FORMAT DQL statement
     * @var $dateExpression
     */
    protected $dateExpression;

    /**
     * Holds the '% format' parameter of the DATE_FORMAT DQL statement
     * var String
     */
    protected $formatChar;

    /**
     * {@inheritDoc}
     */
    public function getSql(SqlWalker $sqlWalker)
    {
        return 'DATE_FORMAT('.$sqlWalker->walkArithmeticExpression( $this->dateExpression ).','.$sqlWalker->walkStringPrimary( $this->formatChar ).')';
    }

    /**
     * {@inheritDoc}
     */
    public function parse(Parser $parser)
    {
        $parser->match( Lexer::T_IDENTIFIER );
        $parser->match( Lexer::T_OPEN_PARENTHESIS );

        $this->dateExpression = $parser->ArithmeticExpression();
        $parser->match( Lexer::T_COMMA );

        $this->formatChar = $parser->ArithmeticExpression();

        $parser->match( Lexer::T_CLOSE_PARENTHESIS );
    }
}
