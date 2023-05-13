using LifeStyleStore.Data.Base;
using LifeStyleStore.Data.ViewModels;
using LifeStyleStore.Models;
using System.Threading.Tasks;

namespace LifeStyleStore.Data.Services
{
    public interface ProductsService: IEntityBaseRepository<ProductModel>
    {
        Task<ProductModel> GetProductModelByIdAsnc(int id);

        Task<NewProductDropdown> GetNewProductDropdownValues();

        Task AddNewProductAsync(NewProduct data);

       Task UpdateProductAsync(NewProduct data);

       
    }
}
