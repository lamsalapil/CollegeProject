
using LifeStyleStore.Data.Base;
using LifeStyleStore.Models;

using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;

namespace LifeStyleStore.Data.Services
{
    public class BrandService : EntityBaseRepository<BrandModel>, BrandsServices
    {
        public BrandService(AdDbContext context) : base(context) { }
    }
}
