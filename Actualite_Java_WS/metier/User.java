package metier;

import javax.xml.bind.annotation.XmlRootElement;

@XmlRootElement
public class User {

	 protected long id;

	    public User(String role, String motdepasse) {
	        this.role = role;
	        this.motdepasse = motdepasse;
	    }

	    public User() {
			super();
		}

		protected String nom;

	    protected String prenom;

	    protected String email;

	    protected String role;

	    protected int valide;

	    protected String motdepasse;


	    public User(long id, String nom, String prenom, String email, String role, int valide, String motdepasse) {
	        this.id = id;
	        this.nom = nom;
	        this.prenom = prenom;
	        this.email = email;
	        this.role = role;
	        this.valide = valide;
	        this.motdepasse = motdepasse;
	    }
	    
	    public User( String nom, String prenom, String email, String role,  String motdepasse) {
	       
	        this.nom = nom;
	        this.prenom = prenom;
	        this.email = email;
	        this.role = role;
	       
	        this.motdepasse = motdepasse;
	    }

	    public void setId(long id) {
	        this.id = id;
	    }

	    public void setNom(String nom) {
	        this.nom = nom;
	    }

	    public void setPrenom(String prenom) {
	        this.prenom = prenom;
	    }

	    public void setEmail(String email) {
	        this.email = email;
	    }

	    public void setRole(String role) {
	        this.role = role;
	    }

	    public void setValide(int valide) {
	        this.valide = valide;
	    }

	    public void setMotdepasse(String motdepasse) {
	        this.motdepasse = motdepasse;
	    }

	    public long getId() {
	        return id;
	    }

	    public String getNom() {
	        return nom;
	    }

	    public String getPrenom() {
	        return prenom;
	    }

	    public String getEmail() {
	        return email;
	    }

	    public String getRole() {
	        return role;
	    }

	    public int getValide() {
	        return valide;
	    }

	    public String getMotdepasse() {
	        return motdepasse;
	    }
}
