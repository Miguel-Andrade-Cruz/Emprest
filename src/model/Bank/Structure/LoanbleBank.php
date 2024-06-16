<?php

namespace minuz\emprest\model\Bank\Structure;

use minuz\emprest\model\Bank\Concept\Loanble;
use minuz\emprest\model\Bank\Structure\Bank;
use minuz\emprest\model\LoanService\Structure\LoanService;

class LoanbleBank extends Bank implements Loanble
{
    protected static LoanService $loanService;
    
    
    
    public function purchaseLoan(string $cardCode, string $password, float $loanValue): void
    {
        $account = $this->Auth($cardCode, $password);

        $loan = static::$loanService->newLoan($loanValue);

        $account->applyLoan($loan);
    }



    public function viewLoanStatus(string $cardCode, string $password): string
    {
        $account = $this->Auth($cardCode, $password);
        
        return $account->viewLoanStatus();
    }



    public function recievePaymentPortions(string $cardCode, string $password, int $portionsQtd): void
    {
        $account = $this->Auth($cardCode, $password);
        $loan = $account->acessLoan();

        $payment = $loan->payPortions($portionsQtd);
        $this->Vault += $payment;

        return;
    }
}