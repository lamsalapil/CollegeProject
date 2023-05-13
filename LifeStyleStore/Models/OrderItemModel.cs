using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;

namespace LifeStyleStore.Models
{
    public class OrderItemModel
    {
        [Key]
        public int Id { get; set; }

        public int Amount { get; set; }

        public double price { get; set; }

        public int ProductID { get; set; }
        [ForeignKey("ProductID")]

        public virtual ProductModel ProductModel { get; set; }

        public int OrderID { get; set; }
        [ForeignKey("OrderID")]

        public OrderModel OrderModel { get; set; }



    }
}
