using LifeStyleStore.Data;
using LifeStyleStore.Data.Services;
using LifeStyleStore.Models;
using Microsoft.AspNetCore.Authorization;
using Microsoft.AspNetCore.Mvc;
using System.Linq;
using System.Threading.Tasks;

namespace LifeStyleStore.Controllers
{
    public class BrandsController : Controller
    {
        private readonly BrandsServices _service;
        
        public BrandsController(BrandsServices service)
        {
            _service = service;
        }

        [AllowAnonymous]
        public async Task<IActionResult> Index()
        {
            var data = await _service.GetAllAsync();
            return View(data);
        }

//get :brand/create

        public IActionResult Create()
        {
            return View();
        }

        [HttpPost]
        public async Task<IActionResult> Create([Bind("BrandName, BrandLogo, BrandDetails")]BrandModel brands)
        {
            if (!ModelState.IsValid)
            {
                return View(brands);
            }
            await _service.AddAsync(brands);
            return RedirectToAction(nameof(Index));
        }

        //get: brand/details/1
        [AllowAnonymous]
        public async Task<IActionResult> Details(int id)
        {
            var BrandDetails = await _service.GetByIdAsync(id);

            if (BrandDetails == null) return View("Empty");
            return View(BrandDetails);
        }

        // get brand/edit
        
        public async Task<IActionResult> Edit(int id)
        {
            var BrandDetails = await _service.GetByIdAsync(id);

            if (BrandDetails == null) return View("NotFound");

            return View(BrandDetails);
        }
        [HttpPost]
        public async Task<IActionResult> Edit(int id, [Bind("Id, BrandName, BrandLogo, BrandDetails")] BrandModel brands)
        {
            if (!ModelState.IsValid)
            {
                return View(brands);
            }
            await _service.UpdateAsync(id, brands);
            return RedirectToAction(nameof(Index));
        }

        //get Brand/delete
        public async Task<IActionResult> Delete(int id)
        {
            var BrandDetails = await _service.GetByIdAsync(id);

            if (BrandDetails == null) return View("NotFound");

            return View(BrandDetails);
        }
        [HttpPost, ActionName("Delete")]
        public async Task<IActionResult> DeleteConformed(int id)
        {
            var BrandDetails = await _service.GetByIdAsync(id);
            if (BrandDetails == null) return View("NotFound");

            await _service.DeleteAsync(id);
           
            return RedirectToAction(nameof(Index));
        }

    }
}
