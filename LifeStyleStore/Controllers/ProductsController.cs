using LifeStyleStore.Data;
using LifeStyleStore.Data.Services;
using LifeStyleStore.Data.ViewModels;
using Microsoft.AspNetCore.Authorization;
using Microsoft.AspNetCore.Mvc;
using Microsoft.AspNetCore.Mvc.Rendering;
using Microsoft.EntityFrameworkCore;
using System;
using System.Linq;
using System.Threading.Tasks;

namespace LifeStyleStore.Controllers
{
    public class ProductsController : Controller
    {
        
        private readonly ProductsService _service;

        public ProductsController(ProductsService service)
        {
            _service = service;
        }

        public async Task<IActionResult> Index()
        {
            var data = await _service.GetAllAsync();
            return View(data);
        }


        




        //get product/details/id
        public async Task<IActionResult> Detail(int id)
        {
            var productDetail = await _service.GetProductModelByIdAsnc(id);
            return View(productDetail);
        }

        //getL movie/create

        public async Task<IActionResult> Create()
        {
            var ProductData = await _service.GetNewProductDropdownValues();

            ViewBag.Brands = new SelectList(ProductData.brands, "Id", "BrandName");

            return View();
        }

        [HttpPost]
        public async Task<IActionResult> Create(NewProduct product)
        {
            if (!ModelState.IsValid)
            {
                var Data = await _service.GetNewProductDropdownValues();
                ViewBag.Brands = new SelectList(Data.brands, "Id", "BrandName");

                return View(product);
            }
            await _service.AddNewProductAsync(product);

            return RedirectToAction(nameof(Index));
        }

        //get /product/edit

        public async Task<IActionResult> Edit( int id)
        {
            var Data = await _service.GetProductModelByIdAsnc(id);
            if (Data == null) return View("Not found");

            var response = new NewProduct()
            {
                Id = Data.Id,
                Name = Data.Name,
                Description = Data.Description,
                Price = Data.Price,
                photo = Data.photo,
                productCatagory = Data.productCatagory,
                productgender =Data.productgender,
                BrandIds = Data.brand_products.Select(n => n.BrandId).ToList(),
                

            };
            var ProductData = await _service.GetNewProductDropdownValues();
            ViewBag.Brands = new SelectList(ProductData.brands, "Id", "BrandName");

            return View(response);
        }

        [HttpPost]
        public async Task<IActionResult> Edit(int id, NewProduct product)
        {

            if (id != product.Id) return View("Not found");

            if (!ModelState.IsValid)
            {
                var Data = await _service.GetNewProductDropdownValues();
                ViewBag.Brands = new SelectList(Data.brands, "Id", "BrandName");

                return View(product);
            }
            await _service.UpdateProductAsync(product);

            return RedirectToAction(nameof(Index));
        }

        //delete
       

    }
}

