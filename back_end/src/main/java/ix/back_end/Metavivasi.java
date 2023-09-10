package ix.back_end;

import jakarta.persistence.Entity;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.GenerationType;
import jakarta.persistence.Id;
import java.time.LocalDateTime;

@Entity // This tells Hibernate to make a table out of this class
public class Metavivasi {
    @Id
    @GeneratedValue(strategy=GenerationType.AUTO)
    private Integer id;

    private Integer accepted, seller_id, dm_id;
    private String car_label, buyer_afm;
    

    public Metavivasi(Integer seller_id, String car_label, String buyer_afm, Integer dm_id) {
        this.seller_id = seller_id;
        this.accepted = 0;
        this.car_label = car_label;
        this.buyer_afm = buyer_afm;
        this.dm_id = dm_id;
    }

    //default constructor
    public Metavivasi(){
    }

    public Integer getId() {
        return id;
    }

    public void setId(Integer id) {
        this.id = id;
    }

    public Integer getAccepted() {
        return accepted;
    }

    public void setAccepted(Integer accepted) {
        this.accepted = accepted;
    }

    public Integer getSeller_id() {
        return seller_id;
    }

    public void setSeller_id(Integer seller_id) {
        this.seller_id = seller_id;
    }

    public Integer getDm_id() {
        return dm_id;
    }

    public void setDm_id(Integer dm_id) {
        this.dm_id = dm_id;
    }

    public String getCar_label() {
        return car_label;
    }

    public void setCar_label(String car_label) {
        this.car_label = car_label;
    }

    public String getBuyer_afm() {
        return buyer_afm;
    }

    public void setBuyer_afm(String buyer_afm) {
        this.buyer_afm = buyer_afm;
    }
    
    
        
}
