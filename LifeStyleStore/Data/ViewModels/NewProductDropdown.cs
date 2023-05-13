
using LifeStyleStore.Data.Enums;
using LifeStyleStore.Models;
using System.Collections.Generic;


namespace LifeStyleStore.Data.ViewModels
{
    public class NewProductDropdown
    {
        public NewProductDropdown()
        {
            brands = new List<BrandModel>();
        }


        public List<BrandModel> brands { get; set; }

            
    }
}
