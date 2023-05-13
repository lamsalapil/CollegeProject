using System.ComponentModel.DataAnnotations;

namespace LifeStyleStore.Models
{
    public class ShoppingCartItemModel
    {
        [Key]

        public int Id { get; set; }

        public ProductModel ProductModel { get; set; }

        public int Amount { get; set; }



        public string ShoppingCartId { get; set; }
    }
}
