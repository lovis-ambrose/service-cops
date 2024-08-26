import java.util.Scanner;

public class BankingSystem {

    public static void main(String[] args) {
        Bank bank = new Bank();
        Scanner scanner = new Scanner(System.in);
        Account loggedInAccount = null;

        while (true) {
            if (loggedInAccount == null) {
                System.out.println("Welcome to the Banking System");
                System.out.println("1. Open Account (Register)");
                System.out.println("2. Login");
                System.out.println("3. Exit");
                System.out.print("Choose an option: ");
                int choice = scanner.nextInt();
                scanner.nextLine();

                switch (choice) {
                    case 1:
                        System.out.print("Enter username: ");
                        String username = scanner.nextLine().toLowerCase();
                        System.out.print("Enter first name: ");
                        String firstName = scanner.nextLine();
                        System.out.print("Enter last name: ");
                        String lastName = scanner.nextLine();
                        System.out.print("Enter email: ");
                        String email = scanner.nextLine();
                        System.out.print("Create a 4-digit Pin: ");
                        String password = scanner.nextLine();
                        System.out.print("Confirm Pin: ");
                        String confirmPassword = scanner.nextLine();
                        boolean registered = bank.registerAccount(username, firstName, lastName, email, password, confirmPassword);
                        if (registered) {
                            loggedInAccount = bank.login(username, password);
                        }
                        break;
                    case 2:
                        System.out.print("Enter username: ");
                        username = scanner.nextLine().toLowerCase();
                        System.out.print("Enter Pin: ");
                        password = scanner.nextLine();
                        loggedInAccount = bank.login(username, password);
                        break;
                    case 3:
                        System.out.println("Exiting the banking system. Goodbye!");
                        scanner.close();
                        return;
                    default:
                        System.out.println("Invalid option. Please try again.");
                        break;
                }
            } else {
                System.out.println("Banking Operations:");
                System.out.println("1. Deposit");
                System.out.println("2. Withdraw");
                System.out.println("3. Check Balance");
                System.out.println("4. Close Account");
                System.out.println("5. Logout");
                System.out.print("Choose an option: ");
                int choice = scanner.nextInt();
                scanner.nextLine(); // Consume newline

                switch (choice) {
                    case 1:
                        System.out.print("Enter amount to deposit: ");
                        double depositAmount = scanner.nextDouble();
                        loggedInAccount.deposit(depositAmount);
                        break;
                    case 2:
                        System.out.print("Enter amount to withdraw: ");
                        double withdrawAmount = scanner.nextDouble();
                        loggedInAccount.withdraw(withdrawAmount);
                        break;
                    case 3:
                        loggedInAccount.displayAccountDetails();
                        break;
                    case 4:
                        bank.closeAccount(loggedInAccount.getUsername());
                        loggedInAccount = null;
                        break;
                    case 5:
                        System.out.println("Logging out...");
                        loggedInAccount = null;
                        break;
                    default:
                        System.out.println("Invalid option. Please try again.");
                        break;
                }
            }
        }
    }
}
