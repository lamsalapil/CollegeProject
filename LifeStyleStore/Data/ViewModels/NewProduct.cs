using LifeStyleStore.Data.Enums;
using LifeStyleStore.Models;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;

namespace LifeStyleStore.Data.ViewModels
{
    public class NewProduct

    {
        public int Id { get; set; }

        [Display(Name = " Product Name")]
        [Required (ErrorMessage = "Name is required")]
        
        public string Name { get; set; }

        [Display(Name = " Product Discription")]
        [Required(ErrorMessage = "Discription is required")]

        public string Description { get; set; }

        [Display(Name = "Product Price is Rs.")]
        [Required(ErrorMessage = "Price is required")]

        public double Price { get; set; }

        [Display(Name = " Product Gender.")]
        [Required(ErrorMessage = "Gender is required")]

        public productgender productgender { get; set; }

        [Display(Name = " Product photo url")]
        [Required(ErrorMessage = "Photo is required")]

        public string photo { get; set; }

        [Display(Name = " Product Catagory.")]
        [Required(ErrorMessage = "Catagory is required")]

        public productCategory productCatagory { get; set; }

        [Display(Name = " Select brand.")]
        [Required(ErrorMessage = "product brand is required")]

        public List<int> BrandIds { get; set; }



    }
}
