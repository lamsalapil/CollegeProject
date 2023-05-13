using LifeStyleStore.Models;
using Microsoft.AspNetCore.Identity.EntityFrameworkCore;
using Microsoft.EntityFrameworkCore;


namespace LifeStyleStore.Data
{
    public partial class AdDbContext:IdentityDbContext<ApplicationUser>
    {
        public AdDbContext(DbContextOptions<AdDbContext> options) : base(options)
        {
        }

        protected override void OnModelCreating(ModelBuilder modelBuilder)
        {
            modelBuilder.Entity<Brand_Products>().HasKey(bp => new
            {
                bp.BrandId,
                bp.ProductsId
            });
           

            modelBuilder.Entity<Brand_Products>().HasOne(b => b.Products).WithMany(bp => bp.brand_products).HasForeignKey(b => b.BrandId);

            modelBuilder.Entity<Brand_Products>().HasOne(b => b.Brands).WithMany(bp => bp.brand_Products).HasForeignKey(b => b.ProductsId);


            base.OnModelCreating(modelBuilder);

        }

       

        public DbSet<BrandModel> Brands { get; set; }

        public DbSet<ProductModel> Products { get; set; }

        public DbSet<Brand_Products> brand_Products { get; set; }



        //order releted tables

        public DbSet<OrderModel> orderModels { get; set; }
        
        public DbSet<OrderItemModel> orderItemModels { get; set; }

        public DbSet<ShoppingCartItemModel> ShoppingCartItemModels { get; set; }
       
    }
}
