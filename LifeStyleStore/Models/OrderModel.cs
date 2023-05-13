
using Microsoft.EntityFrameworkCore.Metadata.Internal;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;

namespace LifeStyleStore.Models
{
    public class OrderModel
    {
        [Key ]
        public int Id { get; set; }

        public string Email { get; set; }

        public string UserId { get; set; }

        public List<OrderItemModel> OrderItemModel { get; set; }
    }
}
