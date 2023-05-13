
using LifeStyleStore.Data.Base;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;

namespace LifeStyleStore.Models
{
    public class BrandModel : IEntityBase
    {
        
        [Key]
        public int Id { get; set; }


        [Display(Name = "Brand Name")]
        [Required(ErrorMessage = "name is required")]
        [StringLength(50, MinimumLength = 3, ErrorMessage = "Full Name must be between 3 and 50 chars")]
        public string BrandName { get; set; }

        [Display(Name = "Logo")]
        public string BrandLogo { get; set; }

        [Display(Name = "Brand Details")]
        [Required(ErrorMessage = "Details is required")]
        public string BrandDetails { get; set; }

        
        //Relationships
        public List<Brand_Products> brand_Products { get; set; }
       
    }
}
