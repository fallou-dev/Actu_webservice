package Exceptions;



@SuppressWarnings("serial")
public class DbConnectionException extends Exception{
	
    public DbConnectionException(String errorString) {
        super(errorString);
    }
}