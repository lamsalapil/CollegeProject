/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Courier_Management_System.Customer;

/**
 *
 * @author apil
 */

public class user {
    private String usern;
    private String passd;
    private String fullname;
    private String address;
    private String contact;
    private String email;
   
    public String getFullname() {
        return fullname;
    }

    public String getAddress() {
        return address;
    }

    public String getContact() {
        return contact;
    }

    public String getEmail() {
        return email;
    }
    
    public void setFullname(String fullname) {
        this.fullname = fullname;
    }

    public void setAddress(String address) {
        this.address = address;
    }

    public void setContact(String contact) {
        this.contact = contact;
    }

    public void setEmail(String email) {
        this.email = email;
    }
    

    
    
    public void setUsern(String usern) {
        this.usern = usern;
    }

    public void setPassd(String passd) {
        this.passd = passd;
    }

    public String getUsern() {
        return usern;
    }

    public String getPassd() {
        return passd;
    }
  @Override
    public String toString() {
        return "user{" + "usern=" + usern + ", passd=" + passd + ", fullname=" + fullname + ", address=" + address + ", contact=" + contact + ", email=" + email + '}';
    }
}
class deliverys extends user{
    private String status;

    public deliverys(String status, String age) {
        this.status = status;
        this.age = age;
    }
    
    private String age;

    
    public String getStatus() {
        return status;
    }

    public void setStatus(String status) {
        this.status = status;
    }

    public String getAge() {
        return age;
    }

    public void setAge(String age) {
        this.age = age;
    }
    
    
}