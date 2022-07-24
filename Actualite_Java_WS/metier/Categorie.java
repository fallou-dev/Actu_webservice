package metier;


import javax.xml.bind.annotation.*;

@XmlRootElement
public class Categorie {
	 public Categorie() {
			super();
		}

		protected int id;

	    protected String libelle;

	    public Categorie(int id, String libelle) {
	    	super();
	        this.id = id;
	        this.libelle = libelle;
	    }
	    public Categorie( String libelle) {
	        super();
	        this.libelle = libelle;
	    }

	    public int getId() {
	        return id;
	    }

	    public String getLibelle() {
	        return libelle;
	    }

	    public void setId(int id) {
	        this.id = id;
	    }

	    public void setLibelle(String libelle) {
	        this.libelle = libelle;
	    }
}
