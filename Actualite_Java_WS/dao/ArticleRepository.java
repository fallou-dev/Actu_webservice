package dao;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import metier.Article;
import Exceptions.DbConnectionException;

public class ArticleRepository {
    private static Connection sql = null;
    private static ArticleRepository instance = new ArticleRepository();

    private ArticleRepository() {
    	try {
            sql = MysqlConnect.getConnection();
        } catch (DbConnectionException e) {
            System.out.println(e.getMessage());
        }

    }

    String LOGIN_STRING = "root";
    String PASSWORD_STRING = "";
    String MYSQL_DRIVER_STRING = "com.mysql.cj.jdbc.Driver";
    String MYSQL_DB_STRING = "jdbc:mysql://localhost/mglsi_news";
    private static Connection connection = null;
    
    public ArrayList<Article> findAll() {
        ArrayList<Article> Articles = new ArrayList<Article>();
        try {
        	connection = DriverManager.getConnection(MYSQL_DB_STRING, LOGIN_STRING, PASSWORD_STRING);
            PreparedStatement query = connection.prepareStatement("SELECT * FROM Article");
            ResultSet result = query.executeQuery();
            while (result.next()) {
            	
                Articles.add(new Article(result.getInt("id"), result.getString("titre"), result.getString("contenu"),
                        result.getDate("datecreation") , result.getDate("datemodifcation"), result.getInt("categorie") ));
            }
            return Articles;
        } catch (SQLException e) {
        	System.out.println(" "+e.getMessage());
        }
		return Articles;
    }
}
