using LifeStyleStore.Data.Base;
using LifeStyleStore.Data.Enums;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;

namespace LifeStyleStore.Models
{
    public class ProductModel : IEntityBase
    {
        [Key]
        public int Id { get; set; }

        public string Name { get; set; }

        public string Description { get; set; }

        public double Price { get; set; }

        public productgender productgender { get; set; }

        public string photo { get; set; }

        public productCategory productCatagory { get; set; }

        //brand relationship
        public List<Brand_Products> brand_products { get; set; }

       



    }
}
