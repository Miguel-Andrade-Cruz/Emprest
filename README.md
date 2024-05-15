# Reference

## Table of actions: Client
|Code| Function |
|--|--|
| `createNewAccount(string $accountCode, string $password): void` | Creates a new Account.|
| `deposit(string $account, int $amount): void` | Deposits the specified value in the specified account. |
| `purchaseLoan(string $account, int $amount, string $plan):  void` | Got a loan with the specified value. The portions and interest are seleted by the specified plan. |
| `checkLoanAmount(string $account):  int|false` | If there is an active Loan, returns the value of it.|
| `checkPortionsPrice(string $account):  int` | Returns the value of each portion. |
| `enter checkRemainedPortions(string $account):  intcode here` | Returns how many portions you have to pay in the moment.|
| `getAccount(string $accountCode, string $password):  Account|false` | Returns the specified Account object. |
| `getName():  string` | Returns the Client  name.|