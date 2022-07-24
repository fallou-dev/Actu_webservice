package metier;




import java.util.Date;

import javax.xml.bind.annotation.*;
import metier.Article;


@XmlRootElement
public class Article {

    protected long id;

    protected String titre;

    protected String contenu;

    protected Date datecreation;

    protected Date datemodification;

    protected int categorie;

    public Article(long id, int categorie, String contenu, Date datecreation, Date datemodification,String titre) {
        this.id = id;
        this.titre = titre;
        this.contenu = contenu;
        this.datecreation = datecreation;
        this.datemodification = datemodification;
        this.categorie = categorie;
    }
    
    

    public Article() {
		super();
	}
    
    



	public Article( int categorie,String contenu, Date datecreation, Date datemodification,String titre) {
		super();
		this.titre = titre;
		this.contenu = contenu;
		this.datecreation = datecreation;
		this.datemodification = datemodification;
		this.categorie = categorie;
	}



	public void setId(long id) {
        this.id = id;
    }

    public void setTitre(String titre) {
        this.titre = titre;
    }

    public void setContenu(String contenu) {
        this.contenu = contenu;
    }

    public void setDatecreation(Date datecreation) {
        this.datecreation =  datecreation;
    }

    public void setDatemodification(Date datemodification) {
        this.datemodification = datemodification;
    }

    public void setCategorie(int categorie) {
        this.categorie = categorie;
    }

    public long getId() {
        return id;
    }

    public String getTitre() {
        return titre;
    }

    public String getContenu() {
        return contenu;
    }

    public Date getDatecreation() {
        return  datecreation;
    }

    public Date getDatemodification() {
        return datemodification;
    }

    public int getCategorie() {
        return categorie;
    }
    
}
