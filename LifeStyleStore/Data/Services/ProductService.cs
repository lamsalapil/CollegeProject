using LifeStyleStore.Data.Base;
using LifeStyleStore.Data.ViewModels;
using LifeStyleStore.Models;
using Microsoft.EntityFrameworkCore;

using System.Linq;
using System.Threading.Tasks;

namespace LifeStyleStore.Data.Services
{
    public class ProductService:EntityBaseRepository<ProductModel>, ProductsService
    {
        private readonly AdDbContext _context;

        public ProductService(AdDbContext context): base(context)
        {
            _context = context;
            

        }

        public async Task AddNewProductAsync(NewProduct data)
        {
            var newProduct = new ProductModel()
            {
                Name = data.Name,
                Description = data.Description,
                Price =data.Price,
                photo = data.photo,
                productgender = data.productgender,
                productCatagory = data.productCatagory,
                


            };
            await _context.Products.AddAsync(newProduct);
            await _context.SaveChangesAsync();
            // add brand
            foreach (var brandsID in data.BrandIds)
            {
                var newBrandProduct = new Brand_Products()
                {
                    BrandId = brandsID,
                    ProductsId = newProduct.Id
                    
                };
                await _context.brand_Products.AddAsync(newBrandProduct);
                
            }
            

        }

        

        public async Task<NewProductDropdown> GetNewProductDropdownValues()
        {
            var response = new NewProductDropdown()
            {
                brands = await _context.Brands.OrderBy(n => n.BrandName).ToListAsync()
            };
          
            
            return response;
        }

        public async Task<ProductModel> GetProductModelByIdAsnc (int id)
        {
            var productDetails = await _context.Products
                .Include( bp => bp.brand_products).ThenInclude(b => b.Brands)
                .FirstOrDefaultAsync( n => n.Id == id);

            return productDetails;
        }

        public async Task UpdateProductAsync(NewProduct data)
        {
            var dbProduct = await _context.Products.FirstOrDefaultAsync(n => n.Id == data.Id);

            if (dbProduct != null)
            {

                dbProduct.Name = data.Name;
                dbProduct.Description = data.Description;
                dbProduct.Price = data.Price;
                dbProduct.photo = data.photo;
                dbProduct.productgender = data.productgender;
                dbProduct.productCatagory = data.productCatagory;
                await _context.SaveChangesAsync();

                
            }
            //remove existing actors
            var existingbranddb = _context.brand_Products.Where(n => n.BrandId == data.Id).ToList();
            _context.brand_Products.RemoveRange(existingbranddb);
            await _context.SaveChangesAsync();
         
            // add brand
            foreach (var brandsID in data.BrandIds)
            {
                var newBrandProduct = new Brand_Products()
                {
                    BrandId = brandsID,
                    ProductsId = data.Id

                };
                await _context.brand_Products.AddAsync(newBrandProduct);

            }
            await _context.SaveChangesAsync();
        }
    }
}
