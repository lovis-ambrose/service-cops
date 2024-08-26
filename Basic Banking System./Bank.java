import java.util.HashMap;
import java.util.Map;

public class Bank {
    private Map<String, Account> accounts = new HashMap<>();

    public boolean registerAccount(String username, String firstName, String lastName, String email, String password, String confirmPassword) {
        if (!password.equals(confirmPassword)) {
            System.out.println("Passwords do not match. Registration failed.");
            return false;
        }

        if (password.length() != 4) {
            System.out.println("Password must be 4 digits long. Registration failed.");
            return false;
        }

        if (accounts.containsKey(username)) {
            System.out.println("Username already exists. Please choose a different username.");
            return false;
        }

        Account newAccount = new Account(username, firstName, lastName, email, password);
        accounts.put(username, newAccount);
        System.out.println("Account registered successfully. Your account number is: " + newAccount.getAccountNumber());
        return true;
    }

    public Account login(String username, String password) {
        Account account = accounts.get(username);
        if (account != null && account.authenticate(password)) {
            System.out.println("Login successful. Welcome, " + account.getUsername() + "!");
            return account;
        } else {
            System.out.println("Invalid username or password.");
            return null;
        }
    }

    public void closeAccount(String username) {
        if (accounts.containsKey(username)) {
            accounts.remove(username);
            System.out.println("Account closed successfully.");
        } else {
            System.out.println("Username does not exist.");
        }
    }
}
