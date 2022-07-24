package Service;

import java.sql.DriverManager;

import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import javax.jws.WebMethod;
import javax.jws.WebParam;
import java.sql.Connection;
import java.util.ArrayList;
import java.util.Date;

import metier.Article;
import metier.Categorie;
import metier.User;

import javax.jws.*;
import javax.jws.WebParam;
@WebService
public class ActualiteService {
	
	String LOGIN_STRING = "root";
    String PASSWORD_STRING = "";
    String MYSQL_DRIVER_STRING = "com.mysql.cj.jdbc.Driver";
    String MYSQL_DB_STRING = "jdbc:mysql://localhost/mglsi_news";
    private static Connection connection = null;
    
    /*Article */


    public void AddArticle( @WebParam(name="categorie")int categorie,
    		@WebParam(name="contenu")String contenu, 
    		@WebParam(name="datecreation")Date datecreation,
    		@WebParam(name="datemodification")Date datemodification,
    		@WebParam(name="titre")String titre
    		) {
    	
    Article article=new Article(categorie,contenu,datecreation,datemodification,titre);
			 
    	
	
        try {
        	connection  = DriverManager.getConnection( MYSQL_DB_STRING, LOGIN_STRING,PASSWORD_STRING);
                PreparedStatement query = connection.prepareStatement(
                        "INSERT INTO Article(categorie,contenu,datecreation , datemodification,titre) VALUES(?,?,?,?,?)");
                
                query.setInt(1, article.getCategorie());
               
             
                query.setString(2, article.getContenu());
                
               
                query.setDate(3,new java.sql.Date(article.getDatecreation().getTime()));
                
                query.setDate(4, new java.sql.Date(article.getDatemodification().getTime()));
                query.setString(5, article.getTitre());
                query.executeUpdate();
          
            } catch (SQLException e) {
            	System.out.println(" "+e.getMessage());
            }
		
    }
	
	private static java.sql.Date convert(java.util.Date uDate) {
        java.sql.Date sDate = new java.sql.Date(uDate.getTime());
        return sDate;
    	
       
    }
	

	
    public void deleteArticleById(@WebParam(name = "id") int id) {
        try {
        	connection = DriverManager.getConnection(MYSQL_DB_STRING, LOGIN_STRING, PASSWORD_STRING);
            PreparedStatement query = connection.prepareStatement("DELETE FROM Article where id=?");
            query.setInt(1, id);
            query.executeUpdate();
        } catch (SQLException e) {
            System.out.println(" "+e.getMessage());;
        }
    }
    
    @WebMethod
    public ArrayList<Article> getAllArticles() {
    	ArrayList<Article> Articles = new ArrayList<Article>();
        try {
        	connection = DriverManager.getConnection(MYSQL_DB_STRING, LOGIN_STRING, PASSWORD_STRING);
            PreparedStatement query = connection.prepareStatement("SELECT * FROM Article");
            ResultSet result = query.executeQuery();
            while (result.next()) {
            	
                Articles.add(new Article(result.getInt("id"), result.getInt("categorie"), result.getString("contenu"),
                        result.getDate("datecreation") , result.getDate("datemodification"), result.getString("titre") ));
            }
            return Articles;
        } catch (SQLException e) {
        	System.out.println(" "+e.getMessage());
        }
		return Articles;
    }
    
  
    public void UpdateArticle(@WebParam(name="id")long id,
    		@WebParam(name="categorie")int categorie,
    		@WebParam(name="contenu")String contenu, 
    		@WebParam(name="datecreation")Date datecreation,
    		@WebParam(name="datemodification")Date datemodification,
    		@WebParam(name="titre")String titre ) {
    	Article article=new Article(id,categorie,contenu,datecreation,datemodification,titre);
        try {
       
        	connection = DriverManager.getConnection(MYSQL_DB_STRING, LOGIN_STRING, PASSWORD_STRING);
            PreparedStatement query = connection.prepareStatement(
                    "UPDATE article SET categorie=?,contenu=?,datecreation=?,datemodification=?,titre=? WHERE id=?");
            query.setInt(1, article.getCategorie());
            
            query.setString(2, article.getContenu());
            query.setDate(3,  new java.sql.Date(article.getDatecreation().getTime()));
            query.setDate(4,  new java.sql.Date(article.getDatemodification().getTime()));
            query.setString(5, article.getTitre());
            query.setLong(6,  article.getId());
            query.executeUpdate();
        } catch (SQLException e) {
        	System.out.println(" "+e.getMessage());
        }
		
    }
    
    @WebMethod
    public Article getArticleById(@WebParam(name = "id") int id) {
    	Article article = new Article();
        try {
        	connection = DriverManager.getConnection(MYSQL_DB_STRING, LOGIN_STRING, PASSWORD_STRING);
            PreparedStatement query = connection.prepareStatement("SELECT * FROM Article WHERE id = ?");
            query.setInt(1, id);
            ResultSet result = query.executeQuery();
            if (result.next()) {
            	article = new Article(result.getInt("id"), result.getInt("categorie"), result.getString("contenu"),
                        result.getDate("datecreation") , result.getDate("datemodification"), result.getString("titre"));
            }
            return article;
        } catch (SQLException e) {
        	System.out.println(" "+e.getMessage());
        }
		return article;
    }
    @WebMethod
    public Article getArticleByCategorie(@WebParam(name = "categorie") int categorie) {
    	Article article = new Article();
        try {
        	connection = DriverManager.getConnection(MYSQL_DB_STRING, LOGIN_STRING, PASSWORD_STRING);
            PreparedStatement query = connection.prepareStatement("SELECT * FROM Article WHERE categorie = ?");
            query.setInt(1, categorie);
            ResultSet result = query.executeQuery();
            if (result.next()) {
            	article = new Article(result.getInt("id"), result.getInt("categorie"), result.getString("contenu"),
                        result.getDate("datecreation") , result.getDate("datemodification"), result.getString("titre"));
            }
            return article;
        } catch (SQLException e) {
        	System.out.println(" "+e.getMessage());
        }
		return article;
    }
    
    
    /* FIN Article */
    
    /*----------------------------------------------------------------------------------------------------------------*/
    
    /*DEBUT USER*/

	
    public void AddUser(@WebParam(name="nom")String nom,
    		@WebParam(name="prenom")String prenom,
    		@WebParam(name="email")String email, 
    		@WebParam(name="role")String role,
    		@WebParam(name="motdepasse")String motdepasse ) {
		User user=new User(nom,prenom,email,role,motdepasse);
    	
        try {
        	connection = DriverManager.getConnection(MYSQL_DB_STRING, LOGIN_STRING, PASSWORD_STRING);

            PreparedStatement query = connection.prepareStatement(
                    "INSERT INTO User(nom,prenom,email,role,motdepasse) VALUES(?,?,?,?,?)");
            query.setString(1, user.getNom());
            query.setString(2, user.getPrenom());
            query.setString(3, user.getEmail());
            query.setString(4, user.getRole());
            query.setString(5, user.getMotdepasse());
            query.executeUpdate();
            } catch (SQLException e) {
            	e.printStackTrace();
            }
		
    }
	
    public void deleteUserById(@WebParam(name = "id") int id) {
        try {
        	connection = DriverManager.getConnection(MYSQL_DB_STRING, LOGIN_STRING, PASSWORD_STRING);
            PreparedStatement query = connection.prepareStatement("DELETE FROM User where id=?");
            query.setInt(1, id);
            query.executeUpdate();
        } catch (SQLException e) {
            System.out.println(" "+e.getMessage());;
        }
    }
    
    @WebMethod
    public ArrayList<User> getAllUsers() {
    	ArrayList<User> users = new ArrayList<User>();
        try {
        	   connection = DriverManager.getConnection(MYSQL_DB_STRING, LOGIN_STRING, PASSWORD_STRING);
        	   PreparedStatement query = connection.prepareStatement("SELECT * FROM User");
               ResultSet result = query.executeQuery();
               while (result.next()) {
                   users.add(new User(result.getInt("id"), result.getString("nom"), result.getString("prenom"),
                           result.getString("email"), result.getString("role"), result.getInt("valide"), result.getString("motdepasse")));
               }
               return users;
        } catch (SQLException e) {
        	System.out.println(" "+e.getMessage());
        }
		return users;
    }
    
    @WebMethod
    public void UpdateUser(@WebParam(name = "User") User user ) {
        try {
       
        	connection = DriverManager.getConnection(MYSQL_DB_STRING, LOGIN_STRING, PASSWORD_STRING);
            PreparedStatement query = connection.prepareStatement(
                    "UPDATE users SET nom=?,prenom=?,email=?,role=?,valide=?,motdepasse=? WHERE id=?");
            query.setString(1, user.getNom());
            query.setString(2, user.getPrenom());
            query.setString(3, user.getEmail());
            query.setString(4, user.getRole());
            query.setInt(4, user.getValide());
            query.setString(5, user.getMotdepasse());
            query.setInt(4, (int) user.getId());
            query.executeUpdate();
        } catch (SQLException e) {
        	System.out.println(" "+e.getMessage());
        }
		
    }
    
    @WebMethod
    public User getUserById(@WebParam(name = "id") int id) {
    	User user = new User();
        try {
        	connection = DriverManager.getConnection(MYSQL_DB_STRING, LOGIN_STRING, PASSWORD_STRING);
            PreparedStatement query = connection.prepareStatement("SELECT * FROM User WHERE id = ?");
            query.setInt(1, id);
            ResultSet result = query.executeQuery();
            if (result.next()) {
            	user = new User(result.getInt("id"), result.getString("nom"), result.getString("prenom"),
                        result.getString("email"), result.getString("role"), result.getInt("valide"), result.getString("motdepasse"));
            }
            return user;
        } catch (SQLException e) {
        	System.out.println(" "+e.getMessage());
        }
		return user;
    }
    /*FIN USER*/
    
    /*--------------------------------------------------------------------------------------------*/
    
    /*DEBUT CATEGORIE*/
	
    public void AddCategorie(@WebParam(name="libelle")String libelle,
    		@WebParam(name="id")int id
    		) {
		Categorie categorie=new Categorie(id,libelle);
    	
        try {
        	connection = DriverManager.getConnection(MYSQL_DB_STRING, LOGIN_STRING, PASSWORD_STRING);
                PreparedStatement query = connection.prepareStatement(
                        "INSERT INTO categorie(id,libelle) VALUES(?,?)");
                query.setInt(1, categorie.getId());
                query.setString(2, categorie.getLibelle());
                query.executeUpdate();
          
            } catch (SQLException e) {
            	System.out.println(" "+e.getMessage());
            }
		
    }
	
    public void deleteCategorieById(@WebParam(name = "id") int id) {
        try {
        	connection = DriverManager.getConnection(MYSQL_DB_STRING, LOGIN_STRING, PASSWORD_STRING);
            PreparedStatement query = connection.prepareStatement("DELETE FROM categorie where id=?");
            query.setInt(1, id);
            query.executeUpdate();
        } catch (SQLException e) {
            System.out.println(" "+e.getMessage());;
        }
    }
    
    @WebMethod
    public ArrayList<Categorie> getAllcategories() {
    	ArrayList<Categorie> categories = new ArrayList<Categorie>();
        try {
        	connection = DriverManager.getConnection(MYSQL_DB_STRING, LOGIN_STRING, PASSWORD_STRING);
            PreparedStatement query = connection.prepareStatement("SELECT * FROM categorie");
            ResultSet result = query.executeQuery();
            while (result.next()) {
            	
                categories.add(new Categorie(result.getInt("id"), result.getString("libelle") ));
            }
            return categories;
        } catch (SQLException e) {
        	System.out.println(" "+e.getMessage());
        }
		return categories;
    }
    
    @WebMethod
    public void Updatecategorie(
    		@WebParam(name="id")int id,
    		@WebParam(name="libelle")String libelle
    		) {
		Categorie categorie=new Categorie(id,libelle);
        try {
       
        	connection = DriverManager.getConnection(MYSQL_DB_STRING, LOGIN_STRING, PASSWORD_STRING);
            PreparedStatement query = connection.prepareStatement(
                    "UPDATE categorie SET libelle=? WHERE id=?");
           
            query.setString(1, categorie.getLibelle());
            query.setInt(2, categorie.getId());
            query.executeUpdate();
        } catch (SQLException e) {
        	System.out.println(" "+e.getMessage());
        }
		
    }
    
    @WebMethod
    public Categorie getcategorieById(@WebParam(name = "id") int id) {
    	Categorie categorie = new Categorie();
        try {
        	connection = DriverManager.getConnection(MYSQL_DB_STRING, LOGIN_STRING, PASSWORD_STRING);
            PreparedStatement query = connection.prepareStatement("SELECT * FROM categorie WHERE id = ?");
            query.setInt(1, id);
            ResultSet result = query.executeQuery();
            if (result.next()) {
            	categorie = new Categorie(result.getInt("id"), result.getString("libelle"));
            }
            return categorie;
        } catch (SQLException e) {
        	System.out.println(" "+e.getMessage());
        }
		return categorie;
    }
    /*FIN CATEGORIE*/
    
    /*-------------------------------------------------------------------------------*/
    
    /*DEBUT AUTHENTIFICATION */
    
    @WebMethod
    public User login(@WebParam(name = "email") String mail , @WebParam(name = "motdepasse") String password) {
    	User user = new User(); 
        try {
        	connection = DriverManager.getConnection(MYSQL_DB_STRING, LOGIN_STRING, PASSWORD_STRING);
        	PreparedStatement query = connection.prepareStatement("SELECT * FROM User WHERE email = ? AND motdepasse = ?");
            query.setString(1, mail);
            query.setString(1, password);
            ResultSet result = query.executeQuery();
            if (result.next()) {
            	user = new User(result.getInt("id"), result.getString("nom"), result.getString("prenom"),
                        result.getString("email"), result.getString("role"), result.getInt("valide"), result.getString("motdepasse"));
            }
            return user;
        } catch (SQLException e) {
            System.out.println(e.getMessage());

        }
        return user;
    }

    /*FIN AUTHENTIFICATION */
}
