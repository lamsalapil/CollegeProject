using LifeStyleStore.Data.Static;
using LifeStyleStore.Models;
using Microsoft.AspNetCore.Builder;
using Microsoft.AspNetCore.Identity;
using Microsoft.Extensions.DependencyInjection;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;


namespace LifeStyleStore.Data
{
    public class AdDbInitializer
    {
        public static void Seed(IApplicationBuilder applicationBuilder)
        {
            using (var serviceScope = applicationBuilder.ApplicationServices.CreateScope())
            {
                var context = serviceScope.ServiceProvider.GetService<AdDbContext>();
                context.Database.EnsureCreated();


                //brand
                if (!context.Brands.Any())
                {
                    context.Brands.AddRange(new List<BrandModel>()
                    {
                        new BrandModel()
                        {
                            BrandName = "Nike",
                            BrandLogo = "https://docs.google.com/uc?export=download&id=1mq_fez2XsK2nzcf-tX_g-qONr9cr1Oy1",
                            BrandDetails = "the 1992 Ad.,"

                        },
                        new BrandModel()
                        {
                            BrandName = "Nke",
                            BrandLogo = "/",
                            BrandDetails = "the 1999 Ad.,"


                        }
                    });

                    context.SaveChanges();

                }

                //product
                if (!context.Products.Any())
                {
                    context.Products.AddRange(new List<ProductModel>()
                    {
                        new ProductModel()
                        {
                            Name = "tshort",
                            Description = "trejtkj dsfgkdgds sdsfmskdfm",
                            Price = 100,
                            productgender = Enums.productgender.Male,
                            photo = "/",
                            productCatagory = Enums.productCategory.TShirt,
                            
                           
                          
                            


                        },
                         new ProductModel()
                        {
                            Name = "short",
                            Description = "trejtkj dsfgkdgds sdsfmskdfm",
                            Price = 100,
                            productgender = Enums.productgender.Male,
                            photo = "/",
                            productCatagory = Enums.productCategory.Shirt,
                            


                        }

                    });
                    context.SaveChanges();

                }
            }
        }

        public static async Task SeedUsersAndRoleAsync(IApplicationBuilder applicationBuilder)
        {
            using (var serviceScope = applicationBuilder.ApplicationServices.CreateScope())
            {

                //Roles
                var roleManager = serviceScope.ServiceProvider.GetRequiredService<RoleManager<IdentityRole>>();

                if (!await roleManager.RoleExistsAsync(UserRoles.Admin))
                    await roleManager.CreateAsync(new IdentityRole(UserRoles.Admin));
                if (!await roleManager.RoleExistsAsync(UserRoles.User))
                    await roleManager.CreateAsync(new IdentityRole(UserRoles.User));

                //Users
                var userManager = serviceScope.ServiceProvider.GetRequiredService<UserManager<ApplicationUser>>();


                string adminUserEmail = "admin@lifestyle.com";

                var adminUser = await userManager.FindByEmailAsync(adminUserEmail);
                if(adminUser == null)
                {
                    var newAdminUser = new ApplicationUser()
                    {
                        FullName = "Admin User",
                        UserName = "admin-user",
                        Email = adminUserEmail,
                        EmailConfirmed = true
                    };
                    await userManager.CreateAsync(newAdminUser, "Admin@123?");
                    await userManager.AddToRoleAsync(newAdminUser, UserRoles.Admin);
                }


                string appUserEmail = "user@lifestyle.com";

                var appUser = await userManager.FindByEmailAsync(appUserEmail);
                if(appUser == null)
                {
                    var newAppUser = new ApplicationUser()
                    {
                        FullName = "Application User",
                        UserName = "app-user",
                        Email = appUserEmail,
                        EmailConfirmed = true
                    };
                    await userManager.CreateAsync(newAppUser, "User@123?");
                    await userManager.AddToRoleAsync(newAppUser, UserRoles.User);

                }
            }
        }
    }
}
