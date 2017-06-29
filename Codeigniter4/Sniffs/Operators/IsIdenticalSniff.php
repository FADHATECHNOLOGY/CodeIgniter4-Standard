<?php
/**
 * Is Identical
 *
 * @package   CodeIgniter4-Standard
 * @author    Louis Linehan <louis.linehan@gmail.com>
 * @copyright 2017 Louis Linehan
 * @license   https://github.com/louisl/CodeIgniter4-Standard/blob/master/LICENSE MIT License
 */

namespace CodeIgniter4\Sniffs\Operators;

use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Files\File;

/**
 * Boolean Or Sniff
 *
 * Check for is equal '==' operator, should use is identical '==='.
 *
 * @author Louis Linehan <louis.linehan@gmail.com>
 */

class IsIdenticalSniff implements Sniff
{


    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return array(T_IS_EQUAL);

    }//end register()


    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param File $phpcsFile The current file being scanned.
     * @param int  $stackPtr  The position of the current token
     *                        in the stack passed in $tokens.
     *
     * @return void
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        $error = false;

        if ($tokens[$stackPtr]['code'] === T_IS_EQUAL) {
            $error = '"%s" is not allowed, use "===" instead';
        }

        if ($error !== false) {
            $data = array($tokens[$stackPtr]['content']);
            $fix  = $phpcsFile->addFixableError($error, $stackPtr, 'IsEqualNotAllowed', $data);
            if ($fix === true) {
                $phpcsFile->fixer->beginChangeset();
                $phpcsFile->fixer->replaceToken($stackPtr, '===');
                $phpcsFile->fixer->endChangeset();
            }
        }

    }//end process()


}//end class
