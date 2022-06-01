/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Courier_Management_System.ManagingStaff;

/**
 *
 * @author apil
 */
public class orderclass {
    private String itemname;
    private String piece;
    private String weight;
    private String charge;
    
    private String fname;
    private String fpno;
    private String faddress;
    private String fzipcode;
    
    private String tname;
    private String tpno;
    private String taddress;
    private String tzipcode;

    @Override
    public String toString() {
        return "orderclass{" + "itemname=" + itemname + ", piece=" + piece + ", weight=" + weight + ", charge=" + charge + ", fname=" + fname + ", fpno=" + fpno + ", faddress=" + faddress + ", fzipcode=" + fzipcode + ", tname=" + tname + ", tpno=" + tpno + ", taddress=" + taddress + ", tzipcode=" + tzipcode + '}';
    }

    public String getItemname() {
        return itemname;
    }

    public void setItemname(String itemname) {
        this.itemname = itemname;
    }

    public String getPiece() {
        return piece;
    }

    public void setPiece(String piece) {
        this.piece = piece;
    }

    public String getWeight() {
        return weight;
    }

    public void setWeight(String weight) {
        this.weight = weight;
    }

    public String getCharge() {
        return charge;
    }

    public void setCharge(String charge) {
        this.charge = charge;
    }

    public String getFname() {
        return fname;
    }

    public void setFname(String fname) {
        this.fname = fname;
    }

    public String getFpno() {
        return fpno;
    }

    public void setFpno(String fpno) {
        this.fpno = fpno;
    }

    public String getFaddress() {
        return faddress;
    }

    public void setFaddress(String faddress) {
        this.faddress = faddress;
    }

    public String getFzipcode() {
        return fzipcode;
    }

    public void setFzipcode(String fzipcode) {
        this.fzipcode = fzipcode;
    }

    public String getTname() {
        return tname;
    }

    public void setTname(String tname) {
        this.tname = tname;
    }

    public String getTpno() {
        return tpno;
    }

    public void setTpno(String tpno) {
        this.tpno = tpno;
    }

    public String getTaddress() {
        return taddress;
    }

    public void setTaddress(String taddress) {
        this.taddress = taddress;
    }

    public String getTzipcode() {
        return tzipcode;
    }

    public void setTzipcode(String tzipcode) {
        this.tzipcode = tzipcode;
    }
}
